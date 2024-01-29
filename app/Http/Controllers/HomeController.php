<?php

namespace App\Http\Controllers;
use App\Models\Client;
use App\Models\Link;
use Illuminate\Http\Request;
use yajra\Datatables\Datatables;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function queue()
    {
        return Datatables::of(
            Client::query()
        )->editColumn('created_at', function ($row) {
            //change over here
            return date('d-m-Y', strtotime($row->created_at));
        })->addColumn('action', function ($row) {
            $btn = '<a href="' . route('clients.show', $row->client_code) . '"  class="btn btn-success btn-sm">link</a>';
            return $btn;
        })
        ->make(true);
    }

    public function dashboard()
    {
        return Datatables::of(
            Link::query()
            ->join('contacts','links.contact_id', '=', 'contacts.id')
        )->addColumn('action', function ($row) {
            $link = $row->id;
            $btn = '<a href="' . route('link.destroy', $row->link_id) . '"  class="btn btn-danger btn-sm">de-link  </a>';
            return $btn;
        })
        ->make(true);
    }
}
