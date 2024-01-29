<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Contact;
use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use yajra\Datatables\Datatables;

class ClientController extends Controller
{

    private $client_idx;

    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('client.display');
    }

    public function queue()
    {
        return Datatables::of(
            Client::query()
        )->editColumn('created_at', function ($row) {
            //change over here
            return date('d-m-Y', strtotime($row->created_at));
        })->addColumn('ccount', function ($row) {
            $ccount = DB::table('links')->select(DB::raw('count(*) as count'))->where('client_code', '=', $row->client_code)->first()->count;

            return $ccount;
        })->addColumn('action', function ($row) {
            $btn = '<a href="' . route('clients.show', $row->client_code) . '"  class="btn btn-success btn-sm">link</a>';
            return $btn;
        })
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('client.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',

        ], [

            'name.required' => 'name is required'

        ]);

        $string = $request->get('name');
        $words = preg_split('/\s+/', $string);
        $wordCount = count($words);

        $clientCount = DB::table('clients')->count();
        if ($clientCount == 0) {
            $maxPlus = 1;
            $maxId = sprintf('%03d', 1);
        } else {
            $maxPlus = DB::table('clients')->max('client_id');
            $maxPlus = $maxPlus + 1;
            $maxId = sprintf('%03d', $maxPlus);
        }


        if ($wordCount == 1) {
            if (strlen(strtoupper(substr($string, 0, 3))) == 1) {
                $string = strtoupper(substr($string, 0, 3)) . "AA" . $maxId;

            } elseif (strlen(strtoupper(substr($string, 0, 3))) == 2) {
                $string = strtoupper(substr($string, 0, 3)) . "A" . $maxId;
            } else {
                $string = strtoupper(substr($string, 0, 3)) . $maxId;
            }
        } else {
            preg_match_all('/\b\w/', $string, $matches);
            if (strlen(strtoupper(substr(implode('', $matches[0]), 0, 3))) == 2) {
                $string = strtoupper(substr(implode('', $matches[0]), 0, 3)) . "A" . $maxId;
            } else {
                $string = strtoupper(substr(implode('', $matches[0]), 0, 3)) . $maxId;
            }

        }
        $client = new Client();
        $client->name = $request->get('name');
        $client->client_id = $maxPlus;
        $client->client_code = $string;
        $client->save();
        return view('client.create')->with('successMsg', 'Client: ' . $client->name . ' Code: ' . $client->client_code . "\r\n" . 'Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($request)
    {
        $this->client_idx = $request;
        $client = Client::where('client_code', $request)->first();
        $contact = Contact::whereNotIn('id', function($query){
            $query->select('contact_id')
            ->from(with(new Link)->getTable())
            ->where('client_code', $this->client_idx);
        })->get(); 
        return view('client.link', compact('client', 'contact'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        //
    }
}
