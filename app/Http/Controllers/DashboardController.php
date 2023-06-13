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
        $results = Searches::find($searchId);
        $content = json_decode($results['content'], true);
        $rows = $content['data']['hits'];
        $pageDetails = [];
        for ($i = 0; $i < count($rows); $i++) {
            $details = $rows[$i]['doc'];
            if ($details['id'] == $docId) {
                $pageDetails = $details;
                break;
            }
        }
        $data = [
            'title' => 'Screen AML',
            'date' => date('m/d/Y'),
            'pageDetails' => $pageDetails
        ];

        // return view('dashboard.pdf', $data);


        $pdf = PDF::loadView('dashboard.pdf', $data);

        return $pdf->download($pageDetails['name'] . '.pdf');
    }

    public function index()
    {
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
        return view('dashboard.add-credit');
    }

    public function updateBalance(Request $request)
    {
        Log::info('Collect Payment Response', [$request]);

        $data = $request->data;
        Log::info([$data['amount'],$data['phonenumber']]);        

        $phone = $data['phonenumber'];
        $user = User::where('phone', '0'.ltrim($phone,'+256'))->first();
        if(!$user){
            return response('No user found');
        }
        $amount = intval($data['amount']);
        $walletTopup = WalletTopups::where('user_id',$user->id)->where('amount',$amount)->where('status','new')->first();
        if($walletTopup){
            $walletTopup->status = 'Received';
            if ($walletTopup->save()) {
                $user->wallet_balance += $walletTopup->amount;
                $user->save();
                return response('Transaction updated successfully');
            }    
        }else{
            Log::info('No transaction found');
            return response('No transaction found');
        }
    }

    public function recentSearches()
    {
        $searches = Searches::where('created_by', Auth::id())->latest()->get();
        $data = [
            'searches' => $searches,
        ];

        return view('dashboard.recent-searches', ['data' => $data]);
    }

    public function searchForm()
    {
        return view('dashboard.search-form');
    }

    public function searchResults($id)
    {
        $results = Searches::find($id);
        if (!$results) {
            return redirect()->route('dashboard.search');
        }
        return view('dashboard.search-results', ['results' => $results, 'searchId' => $id]);
    }

    public function search(Request $request)
    {
        try {
            Log::info('Search Request', [$request]);
            $search_term = $request->get('search_term');
            $entity_type = $request->get('entity_type');
            $match_types = $request->get('match_types');

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
        $id = $request->id;
        $walletTopup = WalletTopups::find($id);
        return view('dashboard.payment-status', ['walletTopup' => $walletTopup]);
    }

    public function checkPaymentStatus(Request $request)
    {
        $id = $request->id;
        $walletTopup = WalletTopups::find($id);
        return $walletTopup->status;
    }
    public function collectPayment(Request $request)
    {
        try {
            Log::info('Collect Payment Request', [$request]);
            $amount = $request->amount;
            if (isset($amount)) {
                $url = env('BEYONIC_API') . '/collectionrequests';
                $post_data = [
                    "phonenumber" => "256" . ltrim(Auth::user()->phone, "0"),
                    'amount' => $amount,
                    'currency' => 'UGX',
                    "reason" => "Wallet top up with screen aml",
                    "success_message" => "Screen AML: Thank you for choosing us",
                    "send_instructions" => True
                ];
                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
                curl_setopt($ch, CURLOPT_TIMEOUT, 0);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Authorization: Token ' . env('BEYONIC_API_KEY')));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                $result = curl_exec($ch);
                dd($result);
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

    // public function webHook($id){
    //     $url = env('BEYONIC_API') . '/webhooks';
    //     $post_data = [
    //         'event' => 'collection.received',
    //         // 'target' => route('dashboard.update-balance',['id'=>$id])
    //         'target' => 'https://aml.smithandboltons.com/dashboard/update-balance/'.$id
    //     ];
    //     $ch = curl_init($url);
    //     curl_setopt($ch, CURLOPT_POST, 1);
    //     curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
    //     curl_setopt($ch, CURLOPT_TIMEOUT, 0);
    //     curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Authorization: Token ' . env('BEYONIC_API_KEY')));
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    //     $result = curl_exec($ch);
    //     return $result;
    // }

    // public function accesstkn()
    // {
    //     $curl = curl_init();
    //     curl_setopt_array($curl, array(
    //         CURLOPT_URL => 'https://api-uat.integration.go.ug/token',
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_ENCODING => '',
    //         CURLOPT_MAXREDIRS => 10,
    //         CURLOPT_TIMEOUT => 0,
    //         CURLOPT_FOLLOWLOCATION => true,
    //         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //         CURLOPT_CUSTOMREQUEST => 'POST',
    //         CURLOPT_SSL_VERIFYHOST => FALSE,
    //         CURLOPT_SSL_VERIFYPEER => FALSE,
    //         CURLOPT_POSTFIELDS => 'grant_type=client_credentials',
    //         CURLOPT_HTTPHEADER => array(
    //             'Authorization: Basic M0M1T2h6NU13ZDhBMmZ1al91X3FqRUF6RmwwYToySV9Lc21wcVBSNk9zaUlLbFRMc01INlk1a2th',
    //             'Content-Type: application/x-www-form-urlencoded'
    //         ),
    //     ));

    //     $response = curl_exec($curl);
    //     if (curl_errno($curl)) {
    //         $error_msg = curl_error($curl);
    //         Log::info('Search Curl Error', [$error_msg]);
    //         return response(['status' => 'failure', 'message' => $error_msg]);
    //     }
    //     curl_close($curl);
    //     $json = json_decode($response, true);

    //     return $json['access_token'];
    // }

    // public function get_business_registration_details($brn)
    // {
    //     $access = $this->accesstkn();
    //     $curl = curl_init();
    //     curl_setopt_array($curl, array(
    //         CURLOPT_URL => 'https://api-uat.integration.go.ug/t/ursb.go.ug/ursb-brs-api/1.0.0/entity/get_entity_full/' . $brn . '/-/APS-NITA',
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_ENCODING => '',
    //         CURLOPT_MAXREDIRS => 10,
    //         CURLOPT_TIMEOUT => 0,
    //         CURLOPT_FOLLOWLOCATION => true,
    //         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //         CURLOPT_CUSTOMREQUEST => 'GET',
    //         CURLOPT_SSL_VERIFYHOST => FALSE,
    //         CURLOPT_SSL_VERIFYPEER => FALSE,
    //         CURLOPT_HTTPHEADER => array(
    //             'Authorization: Bearer ' . $access
    //         ),
    //     ));

    //     $response = curl_exec($curl);

    //     curl_close($curl);
    //     $xml = simplexml_load_string($response, "SimpleXMLElement", LIBXML_NOCDATA);
    //     $json = json_encode($xml);
    //     $array = json_decode($json, TRUE);
    //     return $array;
    // }
}
