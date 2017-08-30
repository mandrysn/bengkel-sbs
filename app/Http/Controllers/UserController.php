<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Session;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $title = 'Ganti Password User' ;
        $route = 'user';
        $button = 'Ganti';
        
//        $merek = Merek::orderby('kode_merek', 'asc')->paginate(20);
        
        return view('template.create', compact('title', 'route', 'button'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'password' => 'required',
            'password_baru' => 'required',
            'password_konfirmasi' => 'required'
        ]);
        
        if ($request->password_baru == $request->password_konfirmasi) {
            
            $password = User::find(1);
            if (Hash::check($request->password, $password->password)) {
                
                $password->password = bcrypt($request->password_baru);
                $password->save();
                
                Session::flash(
                    "flash_notif", [
                        "level"     => "dismissible alert-success",
                        "message"   => "Berhasil, memperbarui data merek Password Berhasil Di Update"
                    ]);
                
                return redirect('user'); 
            } else {
                Session::flash(
                    "flash_notif", [
                        "level"     => "dismissible alert-danger",
                        "message"   => "Password Lama anda Salah"
                    ]);
                
                return redirect('user'); 
            }
            
        } else {
            Session::flash(
                "flash_notif", [
                    "level"     => "dismissible alert-danger",
                    "message"   => "Ulangi Konfirmasi Password tidak sama dengan Password Baru"
                ]);
            
            return redirect('user'); 
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
