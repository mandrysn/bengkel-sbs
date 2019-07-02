<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permission;
use App\Group;
use App\Modul;
use Auth;
use Session;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->id != '1') {

                return "<script language='javascript'>
                        alert('Anda Tidak Memiliki Akses');
                        document.location='".asset('/')."';
                        </script>";
        
        }

        $title = 'Group';
        $route = 'group';
        $group = Group::where('id', '>', '1')->orderby('nama_group', 'asc')->paginate(10);
        
        return view($route . '.index', compact('title', 'group', 'route'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->id != '1') {
        
                return "<script language='javascript'>
                        alert('Anda Tidak Memiliki Akses');
                        document.location='".asset('/')."';
                        </script>";
        }

        $title  = 'Tambah Group';
        $button = 'Tambah';
        $route  = 'group';

        $modul = Modul::orderby('id', 'asc')->get();
        
        return view($route . '.create', compact('title', 'button', 'route', 'controller', 'modul'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_group' => 'required'
        ]);
        
        $group =  Group::firstOrCreate([
            'nama_group' => $request->nama_group
        ]);
        
        if ( !empty($request->akses) ) {

            foreach ($request->akses as $akses) {
                Permission::firstOrCreate([
                    'group_id' => $group->id,
                    'modul_id' => $akses
                ]);

            }

        }
        
        Session::flash("flash_notif", [
            "level"     => "dismissible alert-success",
            "message"   => "Berhasil, menyimpan data group <strong>$request->nama_group</strong>"
        ]);

        return \Redirect::route('group.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Auth::user()->id != '1') {
           
                return "<script language='javascript'>
                        alert('Anda Tidak Memiliki Akses');
                        document.location='".asset('/')."';
                        </script>";
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    if (Auth::user()->id != '1') {
        
            return "<script language='javascript'>
                    alert('Anda Tidak Memiliki Akses');
                    document.location='".asset('/')."';
                    </script>";
    }

        $title  = 'Ubah Group';
        $button = 'Perbarui';
        $route  = 'group';

        $group = Group::findOrFail($id);
        $modul = Modul::orderby('id', 'asc')->get();
        
            $cek = Permission::where('group_id', $id)
            ->whereExists(function($query) {
                $query->selectRaw('moduls.id')
                      ->from('moduls')
                      ->whereRaw('moduls.id = permissions.modul_id');
            })
            ->get();

        return view($route . '.edit', compact('title', 'button', 'route', 'controller', 'group', 'modul'));
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
        $this->validate($request, [
            'nama_group' => 'required|unique:groups,nama_group,'.$id,
        ]);

        $group = Group::findOrFail($id);
        $group->nama_group = $request->nama_group;
        $group->update();

        $data = Permission::where('group_id', $id)->delete();

        if ( !empty($request->akses) ) {

            foreach ($request->akses as $akses) {
                Permission::firstOrCreate([
                    'group_id' => $id,
                    'modul_id' => $akses
                ]);

            }

        }
        
        Session::flash(
            "flash_notif", [
                "level"     => "dismissible alert-info",
                "message"   => "Berhasil, memperbarui data group <strong>$request->nama_group</strong>"
            ]);
        
        return \Redirect::route('group.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->id != '1') {
                return "<script language='javascript'>
                        alert('Anda Tidak Memiliki Akses');
                        document.location='".asset('/')."';
                        </script>";
        }

        $data = Group::findOrFail($id);
        $data->delete();
        Session::flash(
            "flash_notif",[
                "level"   => "dismissible alert-info",
                "massage" => "Berhasil Mengapus Data <strong>$data->nama_group</strong>"
            ]);
        
        return \Redirect::route('group.index');
    }

    /**
     * Search the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function cari(Request $request)
    {
        $kata_kunci = $request->kata_kunci;
        $title = 'Group - Pencarian ' . $kata_kunci;
        $route = 'group';
        
        $group = Group::where('nama_group', 'LIKE', '%' . $kata_kunci . '%')
                      ->orderBy('nama_group', 'asc')
                      ->paginate(10);
                      
        return view('group.index', compact('title', 'group', 'route'));
    }
}
