<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function admin()
    {
        $role = Role::get()->count();
        $user = User::get()->count();
        return response()->json(compact('role','user'));
    }
}
