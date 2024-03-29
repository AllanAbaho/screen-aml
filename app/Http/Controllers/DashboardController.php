<?php

namespace App\Http\Controllers;

use App\Models\Searches;
use App\Models\User;
use App\Models\WalletTopups;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Support\Facades\Auth;
use PDF;

class DashboardController extends Controller
{
    public function generatePDF($searchId, $docId)
    {
        if (Auth::user()->role != 'Client') {
            return view('no-permission');
        }

        $user = User::where('id', Auth::id())->first();
        // if ($user->wallet_balance < 2500) {
        //     return redirect()->route('dashboard.search-results', ['id' => $searchId])->with('success', "Insufficient balance. Please top up to proceed");
        // }


        $results = Searches::find($searchId);
        $content = json_decode($results['content'], true);
        $rows = $content['data']['hits'];
        $niraDetails = $content['nira'] ?? null;
        $ursbDetails = $content['ursb'] ?? null;

        $pageDetails = [];
        for ($i = 0; $i < count($rows); $i++) {
            $details = $rows[$i]['doc'];
            if ($details['id'] == $docId) {
                $pageDetails = $details;
                break;
            }
        }
        $data = [
            'title' => 'KYC UGANDA',
            'date' => date('m/d/Y'),
            'pageDetails' => $pageDetails,
            'niraDetails' => $niraDetails,
            'ursbDetails' => $ursbDetails,
        ];

        $fileName = $pageDetails['name']  ?? $niraDetails['surname'] ?? $ursbDetails['entity_name'];
        // dd($fileName, $pageDetails, $niraDetails);
        // $user->wallet_balance = $user->wallet_balance - 2500;
        // $user->save();

        $pdf = PDF::loadView('dashboard.pdf', $data);
        return $pdf->download($fileName . '.pdf');

        // if ($pdf->download($pageDetails['name'] . '.pdf')) {
        //     $user->wallet_balance = $user->wallet_balance - 2500;
        //     $user->save();
        //     return redirect()->route('dashboard.search-results', ['id' => $searchId])->with('success', "Download successful and account debited successfully");

        // }
    }

    public function index()
    {
        if (Auth::user()->role != 'Client') {
            return redirect()->route('admin.index');
        }

        $searchCount = Searches::where('created_by', Auth::id())->count();
        $searches = Searches::where('created_by', Auth::id())->latest()->take(6)->get();
        $data = [
            'searchCount' => $searchCount,
            'searches' => $searches,
        ];
        return view('dashboard.index', ['data' => $data]);
    }

    public function addCredit()
    {
        if (Auth::user()->role != 'Client') {
            return view('no-permission');
        }

        return view('dashboard.add-credit');
    }

    public function updateBalance(Request $request)
    {
        Log::info('Collect Payment Response', [$request]);

        $data = $request->data;
        Log::info([$data['amount'], $data['phonenumber']]);

        $phone = $data['phonenumber'];
        $user = User::where('phone', '0' . ltrim($phone, '+256'))->first();
        if (!$user) {
            return response('No user found');
        }
        $amount = intval($data['amount']);
        $walletTopup = WalletTopups::where('user_id', $user->id)->where('amount', $amount)->where('status', 'new')->first();
        if ($walletTopup) {
            $walletTopup->status = 'Received';
            if ($walletTopup->save()) {
                $user->wallet_balance += $walletTopup->amount;
                $user->save();
                return response('Transaction updated successfully');
            }
        } else {
            Log::info('No transaction found');
            return response('No transaction found');
        }
    }

    public function recentSearches()
    {
        if (Auth::user()->role != 'Client') {
            return view('no-permission');
        }

        $searches = Searches::where('created_by', Auth::id())->latest()->get();
        $data = [
            'searches' => $searches,
        ];

        return view('dashboard.recent-searches', ['data' => $data]);
    }

    public function searchForm()
    {
        if (Auth::user()->role != 'Client') {
            return view('no-permission');
        }

        return view('dashboard.search-form');
    }

    public function ugandanPerson()
    {
        if (Auth::user()->role != 'Client') {
            return view('no-permission');
        }

        return view('dashboard.ugandan-person');
    }

    public function ugandanCompany()
    {
        if (Auth::user()->role != 'Client') {
            return view('no-permission');
        }

        return view('dashboard.ugandan-company');
    }

    public function searchResults($id)
    {
        if (Auth::user()->role != 'Client') {
            return view('no-permission');
        }

        $results = Searches::find($id);
        if (!$results) {
            return redirect()->route('dashboard.search');
        }
        return view('dashboard.search-results', ['results' => $results, 'searchId' => $id]);
    }

    public function search(Request $request)
    {
        if (Auth::user()->role != 'Client') {
            return view('no-permission');
        }

        try {
            Log::info('Search Request', [$request]);
            $search_term = $request->get('search_term');
            $nin = $request->get('nin');
            $brn = $request->get('brn');
            $entity_type = $request->get('entity_type');
            $match_types = $request->get('match_types');
            $personData = [];
            $businessData = [];
            if (isset($nin)) {
                $person = $this->getPerson($nin);
                $transactionStatus = $person['transactionStatus']['transactionStatus'];
                if ($transactionStatus == 'Error') {
                    $error_msg = $person['transactionStatus']['error']['message'];
                    return redirect()->back()->with('success', $error_msg);
                }
                $search_term = $person['surname'] . ' ' . $person['givenNames'];
                $personData = [
                    "nationalId" => $person['nationalId'],
                    "surname" => $person['surname'],
                    "givenNames" => $person['givenNames'],
                    "dateOfBirth" => $person['dateOfBirth'],
                    "gender" => $person['gender'],
                    "nationality" => $person['nationality'],
                    "livingStatus" => $person['livingStatus'],
                    "maritalStatus" => $person['maritalStatus'],
                    "eMail1" => $person['eMail1'],
                    "addressLine1" => $person['addressLine1'],
                ];
            }
            if (isset($brn)) {
                $business = $this->getBusiness($brn);
                if (isset($business['error_code'])) {
                    return redirect()->back()->with('success', $business['error_code']);
                }
                $search_term = $business['entity_name'];
                $businessData = [
                    'cert_number' => $business['cert_number'],
                    'entity_name' => $business['entity_name'],
                    'company_type' => $business['company_type'],
                    'applicant' => $business['metadata']['applicant'],
                    'reg_date' => $business['reg_date'],
                    'phone_mobile' => $business['metadata']['group_applicant']['phone_mobile'],
                ];
            }
            if (isset($search_term) && isset($entity_type)) {
                $url = env('COMPLY_API') . '/searches';
                $post_data = [
                    'search_term' => $search_term,
                    "fuzziness" => 0.6,
                    "filters" => [
                        "entity_type" => $entity_type,
                        "types" => $match_types
                    ],
                ];
                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
                curl_setopt($ch, CURLOPT_TIMEOUT, 0);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Authorization: Token ' . env('COMPLY_API_KEY')));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                $result = curl_exec($ch);
                if (curl_errno($ch)) {
                    $error_msg = curl_error($ch);
                    Log::info('Search Curl Error', [$error_msg]);
                    return response(['status' => 'failure', 'message' => $error_msg]);
                }
                curl_close($ch);
                $result = (json_decode($result, true));
                Log::info('Search Response', [$result]);
                if ($result['status'] == 'success') {
                    $result['content']['nira'] = $personData;
                    $result['content']['ursb'] = $businessData;

                    $search = new Searches();
                    $search->name = $search_term;
                    $search->content = json_encode($result['content']);
                    $search->created_by = Auth::id();
                    $search->updated_by = Auth::id();
                    $search->save();
                    return redirect()->route('dashboard.search-results', ['id' => $search->id])->with('message', 'Search results retrieved successfully!!!');

                    return response(['status' => $result['status'], 'content' => $result['content']]);
                } else {
                    return response(['status' => $result['status'], 'message' => $result['message']]);
                }
            } else {
                return response(['status' => 'failure', 'message' => 'Invalid request, some parameters were not passed in the payload.']);
            }
        } catch (Exception $e) {
            Log::info('Search Exception Error', [$e->getMessage()]);
            return response(['status' => 'failure', 'message' => $e->getMessage()]);
        }
    }

    public function paymentStatus(Request $request)
    {
        if (Auth::user()->role != 'Client') {
            return view('no-permission');
        }

        $id = $request->id;
        $walletTopup = WalletTopups::find($id);
        return view('dashboard.payment-status', ['walletTopup' => $walletTopup]);
    }

    public function checkPaymentStatus(Request $request)
    {
        if (Auth::user()->role != 'Client') {
            return view('no-permission');
        }

        $id = $request->id;
        $walletTopup = WalletTopups::find($id);
        return $walletTopup->status;
    }
    public function collectPayment(Request $request)
    {
        if (Auth::user()->role != 'Client') {
            return view('no-permission');
        }

        try {
            Log::info('Collect Payment Request', [$request]);
            $amount = $request->amount;
            if (isset($amount)) {
                $url = env('BEYONIC_API') . '/collectionrequests';
                $post_data = [
                    "phonenumber" => "256" . ltrim(Auth::user()->phone, "0"),
                    'amount' => $amount,
                    'currency' => 'UGX',
                    "reason" => "Wallet top up with KYC UGANDA",
                    "success_message" => "KYC UGANDA: Thank you for choosing us",
                    "send_instructions" => True
                ];
                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
                curl_setopt($ch, CURLOPT_TIMEOUT, 0);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Authorization: Token ' . env('BEYONIC_API_KEY')));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                $result = curl_exec($ch);
                if (curl_errno($ch)) {
                    $error_msg = curl_error($ch);
                    Log::info('Collect Payment Curl Error', [$error_msg]);
                    return response(['status' => 'failure', 'message' => $error_msg]);
                }
                curl_close($ch);
                $result = (json_decode($result, true));
                Log::info('Collect Payment Response', [$result]);
                if ($result['status'] == 'new') {

                    $walletTopup = new WalletTopups;
                    $walletTopup->amount = $amount;
                    $walletTopup->user_id = Auth::id();
                    $walletTopup->status = $result['status'];
                    if ($walletTopup->save()) {
                        $walletTopup->save();
                        return redirect()->route('dashboard.payment-status', ['id' => $walletTopup->id])->with('message', 'Please enter pin to confirm payment');
                    }
                    return response(['status' => $result['status'], 'content' => $result['content']]);
                } else {
                    return response(['status' => $result['status'], 'message' => $result['message']]);
                }
            } else {
                return response(['status' => 'failure', 'message' => 'Invalid request, some parameters were not passed in the payload.']);
            }
        } catch (Exception $e) {
            Log::info('Search Exception Error', [$e->getMessage()]);
            return response(['status' => 'failure', 'message' => $e->getMessage()]);
        }
    }

    public function getAccessToken()
    {
        $postData = [
            "appKey" => env('ETHERONE_KEY'),
            "appSecret" => env('ETHERONE_SECRET')
        ];
        $postData = json_encode($postData);

        $ch = curl_init(env('ETHERONE_API') . '/authenticate');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

        $response = curl_exec($ch);
        curl_close($ch);
        Log::info('Access Key', [$response]);
        $decodedResponse = json_decode($response, true);
        $token = $decodedResponse['access_token'];
        return $token;
    }

    public function checkStatus($transactionID)
    {
        $postData = [
            "transactionID" => $transactionID,
        ];
        $postData = json_encode($postData);

        $ch = curl_init(env('ETHERONE_API') . '/collection/enquiry');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Authorization: Bearer ' . $this->getAccessToken()));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

        $response = curl_exec($ch);
        Log::info('Check Status Response', [$response]);
        curl_close($ch);
        $decodedResponse = json_decode($response, true);
        $status = $decodedResponse['status'];

        if ($status == 'SUCCESS') {
            $transactionStatus = $decodedResponse['transaction']['status'];
            $walletTopup = WalletTopups::where('transactionID', $transactionID)->first();
            $walletTopup->status = $transactionStatus;
            $walletTopup->save();
            if ($transactionStatus == 'SUCCESS') {
                $user = User::where('id', $walletTopup->user_id)->first();
                $user->wallet_balance += $walletTopup->amount;
                $user->save();
            }
        }
        return $status;
    }

    public function etheronePayment(Request $request)
    {
        if (Auth::user()->role != 'Client') {
            return view('no-permission');
        }

        try {
            Log::info('Collect Payment Request', [$request]);
            $amount = $request->amount;
            if (isset($amount)) {
                $url = env('ETHERONE_API') . '/collection/request';
                $transactionID = rand(1111111111, 9999999999);
                $post_data = [
                    "msisdn" => "256" . ltrim(Auth::user()->phone, "0"),
                    'amount' => (int) $amount,
                    'transactionID' => (string) $transactionID,
                    "narration" => "Wallet top up with KYC UGANDA",
                ];
                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
                curl_setopt($ch, CURLOPT_TIMEOUT, 0);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Authorization: Bearer ' . $this->getAccessToken()));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                $result = curl_exec($ch);
                if (curl_errno($ch)) {
                    $error_msg = curl_error($ch);
                    Log::info('Collect Payment Curl Error', [$error_msg]);
                    return response(['status' => 'failure', 'message' => $error_msg]);
                }
                curl_close($ch);
                $result = (json_decode($result, true));
                Log::info('Collect Payment Response', [$result]);
                if ($result['code'] == 201) {

                    $walletTopup = new WalletTopups;
                    $walletTopup->amount = $amount;
                    $walletTopup->user_id = Auth::id();
                    $walletTopup->status = $result['status'];
                    $walletTopup->transactionID = $transactionID;
                    if ($walletTopup->save()) {
                        $walletTopup->save();
                        return redirect()->route('dashboard.payment-status', ['id' => $walletTopup->id])->with('message', 'Please enter pin to confirm payment');
                    }
                }
                return response(['status' => $result['status'], 'message' => $result['message']]);
            } else {
                return response(['status' => 'FAILED', 'message' => 'Invalid request, some parameters were not passed in the payload.']);
            }
        } catch (Exception $e) {
            Log::info('Search Exception Error', [$e->getMessage()]);
            return response(['status' => 'failure', 'message' => $e->getMessage()]);
        }
    }

    public function getPerson($nin)
    {
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, 'https://kycuganda.com/api/getPerson/' . $nin);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($curl);
        curl_close($curl);
        Log::info(['Nira Response', $result]);
        return json_decode($result, true)['return'];
    }

    public function getBusiness($brn)
    {
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, 'https://kycuganda.com/api/getBusiness/' . $brn);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($curl);
        curl_close($curl);
        Log::info(['Nira Response', $result]);
        return json_decode($result, true);
    }
}
