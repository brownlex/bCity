<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'client' => 'required',
            'contact' => 'required'
        ], [

            'client.required' => 'client code is required',
            'contact.required' => 'contact is required'

        ]);

        $link = new Link();
        $link->client_code = $request->get('client');
        $link->contact_id = $request->get('contact');
        $link->save();
        return view('client.display')->with('successMsg', 'Client: ' . $link->client_code .' Linked to  '.$link->contact_id.' Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Link $link)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Link $link)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Link $link)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($link)
    {
        Link::Where('link_id','=',$link)->delete();
        return view('home');
    }
}
