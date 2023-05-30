<?php

namespace App\Http\Controllers;

use App\Models\Searches;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // $results = Searches::latest()->take(10)->get();
        // dd($results);
        return view('dashboard.index');
    }

    public function searchForm()
    {
        return view('dashboard.search-form');
    }

    public function searchResults($id)
    {
        $results = Searches::find($id);
        return view('dashboard.search-results', ['results' => $results]);
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
                    "filters"=> [
                        "entity_type"=> $entity_type,
                        "types"=> $match_types
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
}
