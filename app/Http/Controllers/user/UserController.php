<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

// model
use App\Models\Role;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::with('role')->get();
        return response()->json(compact('user'));
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
    public function store(UserRequest $request)
    {
        $request->validated(); // validate biasa
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        // masukin role di user baru
        $user->role()->attach($request->role);
        return response()->json(['pesan' => 'data berhasil di tambahkan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function show(User $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *User
     * @param  \App\Models\User  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $user = User::where('id', $user->id)->with('role')->first();
        return response()->json(compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $request->validated(); // validate biasa
        $users = User::where('id',$user->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->role()->sync([$request->role]); // sync pivotnya atau di update

        return response()->json(['pesan' => 'data berhasil di tambahkan']);

        // update di pivot make method ini


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $users = $user->delete();
        return response()->json(compact('users'));
    }

    public function option()
    {
        $option = Role::all();
        return response()->json(compact('option'));
    }
}
