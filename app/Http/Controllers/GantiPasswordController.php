<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tahunajaran as Tahunajaran;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Auth;
use App\Models\Users as Users;
use Hash;

class GantiPasswordController extends Controller
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
    public function save(Request $request)
    {
        $val = Auth::user();

        if (Hash::check($request->current_password, $val->password)){
             $val->password = bcrypt($request->new_password);
                $val->save();
                return back()->with('sukses_simpan','yes');
          } else{
            return back()->with('gagal_simpan','yes');
          }
    }

    // public function changePassword(Request $request,$id)
    // {
    //     $ubahPassAdmin=User::find($id);
    //     // return $ubahPassAdmin;
    //     if (Hash::check($request->passLama, $ubahPassAdmin->password)){
    //         if ($request->passBaru == $request->confirmPass){
    //          $ubahPassAdmin->password = bcrypt($request->confirmPass);
    //             $ubahPassAdmin->save();
    //             return back();
    //         }
    //       }            
    // }
}
