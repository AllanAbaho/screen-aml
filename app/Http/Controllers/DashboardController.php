<?php

namespace App\Http\Controllers;

use App\Models\Searches;
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
            if ($details['id'] == $docId){
                $pageDetails = $details;
                break;
            }
        }
        $data = [
            'title' => 'Screen AML',
            'date' => date('m/d/Y'),
            'pageDetails'=> $pageDetails
        ];

        // return view('dashboard.pdf', $data);


        $pdf = PDF::loadView('dashboard.pdf', $data);

        return $pdf->download( $pageDetails['name'] .'.pdf');
    }

    public function index()
    {
        $searchCount = Searches::where('created_by',Auth::id())->count();
        // dd($searchCount);
        $data = [
            'searchCount'=>$searchCount
        ];
        return view('dashboard.index',['data'=>$data]);
    }

    public function searchForm()
    {
        return view('dashboard.search-form');
    }

    public function searchResults($id)
    {
        $results = Searches::find($id);
        if(!$results){
            return redirect()->route('dashboard.search');
        }
        return view('dashboard.search-results', ['results' => $results,'searchId'=>$id]);
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

    public function accesstkn()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-uat.integration.go.ug/token',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_SSL_VERIFYHOST => FALSE,
            CURLOPT_SSL_VERIFYPEER => FALSE,
            CURLOPT_POSTFIELDS => 'grant_type=client_credentials',
            CURLOPT_HTTPHEADER => array(
              'Authorization: Basic M0M1T2h6NU13ZDhBMmZ1al91X3FqRUF6RmwwYToySV9Lc21wcVBSNk9zaUlLbFRMc01INlk1a2th',
              'Content-Type: application/x-www-form-urlencoded'
            ),
        ));
    
        $response = curl_exec($curl);
        if (curl_errno($curl)) {
            $error_msg = curl_error($curl);
            Log::info('Search Curl Error', [$error_msg]);
            return response(['status' => 'failure', 'message' => $error_msg]);
        }
curl_close($curl);
        $json = json_decode($response, true);

        return $json['access_token'];
    }

    public function get_business_registration_details($brn)
    {
        $access = $this->accesstkn();
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-uat.integration.go.ug/t/ursb.go.ug/ursb-brs-api/1.0.0/entity/get_entity_full/'.$brn.'/-/APS-NITA',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_SSL_VERIFYHOST => FALSE,
            CURLOPT_SSL_VERIFYPEER => FALSE,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$access
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $xml = simplexml_load_string($response, "SimpleXMLElement", LIBXML_NOCDATA);
        $json = json_encode($xml);
        $array = json_decode($json,TRUE);
        return $array;
    }
}
