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

class AdminController extends Controller
{
    public function generatePDF($searchId, $docId)
    {
        if (Auth::user()->role != 'Admin') {
            return view('no-permission');
        }

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
            'title' => 'KYC UGANDA',
            'date' => date('m/d/Y'),
            'pageDetails' => $pageDetails
        ];

        // return view('dashboard.pdf', $data);


        $pdf = PDF::loadView('dashboard.pdf', $data);

        return $pdf->download($pageDetails['name'] . '.pdf');
    }

    public function index()
    {
        if (Auth::user()->role != 'Admin') {
            return view('no-permission');
        }
        $searchCount = Searches::count();
        $searches = Searches::latest()->take(6)->get();
        $data = [
            'searchCount' => $searchCount,
            'searches' => $searches,
        ];
        return view('admin.index', ['data' => $data]);
    }

    public function users()
    {
        if (Auth::user()->role != 'Admin') {
            return view('no-permission');
        }
        $users = User::where('role', 'Client')->latest()->get();
        return view('admin.users', ['users' => $users]);
    }

    public function recentSearches()
    {
        if (Auth::user()->role != 'Admin') {
            return view('no-permission');
        }

        $searches = Searches::latest()->get();
        $data = [
            'searches' => $searches,
        ];

        return view('admin.recent-searches', ['data' => $data]);
    }

    public function searchResults($id)
    {
        if (Auth::user()->role != 'Admin') {
            return view('no-permission');
        }

        $results = Searches::find($id);
        if (!$results) {
            return redirect()->route('admin.search');
        }
        return view('admin.search-results', ['results' => $results, 'searchId' => $id]);
    }
}
