<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tahunajaran as Tahunajaran;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $tahunajarannavbar = Tahunajaran::all();
        // return view('sarpras.index',array())->with('tahunajarannavbar',$tahunajarannavbar);
        return redirect('/');
    }
}
