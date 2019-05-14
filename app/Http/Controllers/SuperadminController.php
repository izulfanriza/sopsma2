<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Models\Tahunajaran as Tahunajaran;
use App\Models\Users as Users;
use Illuminate\Support\Facades\DB;

class SuperadminController extends Controller
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
        $tahunajarannavbar = Tahunajaran::all();

        $admin = DB::table('users')
        ->where('users.role','=','admin')
        ->select(DB::raw('COUNT(users.id) as jml'))
        ->get();

        $sarpras = DB::table('users')
        ->where('users.role','=','sarpras')
        ->select(DB::raw('COUNT(users.id) as jml'))
        ->get();

        $tu = DB::table('users')
        ->where('users.role','=','tu')
        ->select(DB::raw('COUNT(users.id) as jml'))
        ->get();

        return view('superadmin.index',array())
        ->with('tahunajarannavbar',$tahunajarannavbar)
        ->with('admin',$admin)
        ->with('sarpras',$sarpras)
        ->with('tu',$tu);
    }


    public function getAdmin()
    {
        $tahunajarannavbar = Tahunajaran::all();
        $admin = DB::table('users')
        ->where('role','=','admin')
        ->select('users.*')
        ->get();
        $no = 1;
        return view('superadmin.admin',array())
        ->with('admin',$admin)
        ->with('no',$no)
        ->with('tahunajarannavbar',$tahunajarannavbar);
    }


    public function getAdd()
    {
        $tahunajarannavbar = Tahunajaran::all();
        return view('superadmin.add',array())->with('tahunajarannavbar',$tahunajarannavbar);
    }


    public function getSave(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'nama_petugas' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
        
        if ($validator->fails()) {
            return redirect('superadmin/admin/add')
                ->withErrors($validator)
                ->withInput();
        }
        
        $admin = new Users;
        
        // $data->nama_field_di_database = Input::get('nama_field_di_form');
        $admin->nama_petugas = Input::get('nama_petugas');
        $admin->email = Input::get('email');
        $admin->password = bcrypt(Input::get('password'));
        $admin->role = 'admin';
        
        $admin->save();

        return redirect('superadmin/admin') 
        ->with('sukses_simpan','yes');

    }


    public function getDelete($id)
    {
        Users::find($id)->delete();
        return redirect('superadmin/admin')->with('sukses_hapus','yes');
    }


    public function getShow($id)
    {
        $admin = Users::find($id);
        $tahunajarannavbar = Tahunajaran::all();
        return view('superadmin.show',array())
        ->with('admin',$admin)
        ->with('tahunajarannavbar',$tahunajarannavbar);
    } 


    public function getResetPassword($id)
    {
        $admin = Users::find($id);
        $tahunajarannavbar = Tahunajaran::all();
        return view('superadmin.resetpassword')
        ->with('admin',$admin)
        ->with('tahunajarannavbar',$tahunajarannavbar);
    }


    public function getUpdatePassword($id, Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'password' => 'required|string|min:6|confirmed',
        ]);


        $admin = Users::find($id);
        
        if ($validator->fails()) {
            return redirect('superadmin/admin/resetpassword/'.$admin->id)
                ->withErrors($validator)
                ->withInput();
        }
        
        
        // $data->nama_field_di_database = Input::get('nama_field_di_form');
        $admin->password = bcrypt(Input::get('password'));
        
        $admin->save();
        
        return redirect('superadmin/admin/show/'.$admin->id)->with('sukses_resetpassword','yes');

    }


    public function getEdit($id)
    {
        $admin = Users::find($id);
        $tahunajarannavbar = Tahunajaran::all();
        return view('superadmin.edit')
        ->with('admin',$admin)
        ->with('tahunajarannavbar',$tahunajarannavbar);
    }


    public function getUpdate($id, Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'nama_petugas' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
        ]);

        $admin = Users::find($id);

        if ($validator->fails()) {
            return redirect('superadmin/admin/edit/'.$admin->id)
                ->withErrors($validator)
                ->withInput();
        }
        
        // $data->nama_field_di_database = Input::get('nama_field_di_form');
        $admin->nama_petugas = Input::get('nama_petugas');
        $admin->email = Input::get('email');
        
        $admin->save();
        
        return redirect('superadmin/admin/show/'.$admin->id)->with('sukses_update','yes');

    }


    public function getUsers()
    {
        $tahunajarannavbar = Tahunajaran::all();
        $users = DB::table('users')
        ->where('role','=','sarpras')
        ->orWhere('role','=','tu')
        ->select('users.*')
        ->get();
        $no = 1;
        $tahunajarannavbar = Tahunajaran::all();
        return view('superadmin.users',array())
        ->with('users',$users)
        ->with('no',$no)
        ->with('tahunajarannavbar',$tahunajarannavbar);
    }


    public function getAddUser()
    {
        $tahunajarannavbar = Tahunajaran::all();
        return view('superadmin.adduser',array())->with('tahunajarannavbar',$tahunajarannavbar);
    }


    public function getSaveUser(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'nama_petugas' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required',
        ]);
        
        if ($validator->fails()) {
            return redirect('superadmin/users/add')
                ->withErrors($validator)
                ->withInput();
        }
        
        $users = new Users;
        
        // $data->nama_field_di_database = Input::get('nama_field_di_form');
        $users->nama_petugas = Input::get('nama_petugas');
        $users->email = Input::get('email');
        $users->password = bcrypt(Input::get('password'));
        $users->role = Input::get('role');
        
        $users->save();
        
        return redirect('superadmin/users')->with('sukses_simpan','yes');

    }


    public function getDeleteUser($id)
    {
        Users::find($id)->delete();
        return redirect('superadmin/users')->with('sukses_hapus','yes');
    }

    public function getShowUser($id)
    {
        $users = Users::find($id);
        $tahunajarannavbar = Tahunajaran::all();
        return view('superadmin.showuser',array())
        ->with('users',$users)
        ->with('tahunajarannavbar',$tahunajarannavbar);
    }  



    public function getResetPasswordUser($id)
    {
        $users = Users::find($id);
        $tahunajarannavbar = Tahunajaran::all();
        return view('superadmin.resetpassworduser')
        ->with('users',$users)
        ->with('tahunajarannavbar',$tahunajarannavbar);

        // $tahunajarannavbar = Tahunajaran::all();
        // return view('tahunajaran.add',array())->with('tahunajarannavbar',$tahunajarannavbar);
    }



    public function getUpdatePasswordUser($id, Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'password' => 'required|string|min:6|confirmed',
        ]);
        
        $users = Users::find($id);

        if ($validator->fails()) {
            return redirect('superadmin/users/resetpassword/'.$users->id)
                ->withErrors($validator)
                ->withInput();
        }
        
        
        // $data->nama_field_di_database = Input::get('nama_field_di_form');
        $users->password = bcrypt(Input::get('password'));
        
        $users->save();
        
        return redirect('superadmin/users/show/'.$users->id)->with('sukses_resetpassword','yes');

    }


    public function getEditUser($id)
    {
        $users = Users::find($id);
        $tahunajarannavbar = Tahunajaran::all();
        return view('superadmin.edituser')
        ->with('users',$users)
        ->with('tahunajarannavbar',$tahunajarannavbar);

        // $tahunajarannavbar = Tahunajaran::all();
        // return view('tahunajaran.add',array())->with('tahunajarannavbar',$tahunajarannavbar);
    }


    public function getUpdateUser($id, Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'nama_petugas' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'role' => 'required',
        ]);

        $users = Users::find($id);

        if ($validator->fails()) {
            return redirect('superadmin/users/edit/'.$users->id)
                ->withErrors($validator)
                ->withInput();
        }
        
        // $data->nama_field_di_database = Input::get('nama_field_di_form');
        $users->nama_petugas = Input::get('nama_petugas');
        $users->email = Input::get('email');
        $users->role = Input::get('role');
        
        $users->save();
        
        return redirect('superadmin/users/show/'.$users->id)->with('sukses_update','yes');

    }


    public function getSuperadmin($id, Request $request)
    {
        $idsuperadmin = Users::where('role','=','superadmin')->pluck('id')[0];;
        $superadminnow = Users::find($idsuperadmin);
        $superadminnow->role = 'admin';
        $superadminnow->save();
        
        $superadmin = Users::find($id);
        $superadmin->role = 'superadmin';
        $superadmin->save();
        return redirect('admin/index')->with('sukses_gantisuperadmin','yes');
    }
}
