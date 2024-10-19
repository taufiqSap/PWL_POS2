<?php

namespace App\Http\Controllers;

class WelcomeController extends Controller 
{     
        public function index()
        {
                $breadcrumb = (object) [
                        'title' => 'Selamat Datang',
                        'list'  => ['Home', 'Welcome']
                ];

                $activeMenu = 'dashboard';

                return view('Welcome',['breadcrumb' => $breadcrumb, 'activeMenu' => $activeMenu]);
        }
} 


