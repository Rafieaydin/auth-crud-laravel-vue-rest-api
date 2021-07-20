<?php

namespace App\Http\Controllers\role;


// model
use App\Models\Role;
use App\Models\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\RoleRequesr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = Role::all();
        return response()->json(compact('role'));
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
    public function store(RoleRequesr $request)
    {
        $request->validated();
        Role::create($request->all());
        return response()->json(['pesan' => 'data berhasil di tambah']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $role = Role::find($role->id);
        return response()->json(compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequesr $request, Role $role)
    {
        $request->validated();
        $role->update($request->all());
        return response()->json(['pesan' => 'data berhasil di update']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
   $role->delete();
        return response()->json(['pesan' => 'data berhasil di hapus']);
    }
}
