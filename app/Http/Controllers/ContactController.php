<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use yajra\Datatables\Datatables;


class ContactController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
     return view('contact.display');
    }

    public function queue()
    {
        return Datatables::of(
            Contact::query()
        )->editColumn('created_at', function ($row) {
            //change over here
            return date('d-m-Y', strtotime($row->created_at));
        })->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('contact.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
        $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required|email',
        ], [

            'name.required' => 'name is required',
            'surname.required' => 'surname is required',
            'email.required' => 'email is required|not a valid email format'

        ]);

        $contact = new Contact();
        $contact->name = $request->get('name');
        $contact->surname = $request->get('surname');
        $contact->email = $request->get('email');
        $contact->save();
        return view('contact.create')->with('successMsg', 'Contact: ' . $contact->name .' '.$contact->surname.' Created Successfully');
    }
    catch(QueryException $exception) {
        $message = $exception->getMessage();
        $error_code = $exception->errorInfo[1];
        if($error_code == 1062){
            $message = 'Duplicate entry';
        }
        return back()->withError($message)->withInput();
    }
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        //
    }
}
