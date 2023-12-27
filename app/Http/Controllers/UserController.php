<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $userLogged = request()->user();

        $users = User::where('uuid', '!=', $userLogged->uuid)->get();

        return response()->json([
            'success' => true,
            'users' => $users
        ], 200);
    }

    public function show($uuid)
    {
        $user = User::where('uuid', $uuid)->first();
        return response()->json([
            'success' => true,
            'user' => $user
        ], 200);
    }

  
}
