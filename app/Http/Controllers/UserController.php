<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $data = [
            'nama' => 'Pelanggan pertama',
        ];
        UserModel::where('username', 'customer-1')->update($data); // update record in m_user table

        // Access all UserModel instances
        $user = UserModel::all();
        return view('user', ['data' => $user]);
    }
}
