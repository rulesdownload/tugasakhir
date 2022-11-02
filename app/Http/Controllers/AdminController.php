<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Models\post_raw;

class AdminController extends Controller
{
    //
        public function view() {

        return view('admin.dashboard');
    }

        public function ShowPost() {

        return view('admin.ShowPost');
    }

        public function Show() {

        return view('admin.Kelola');
    }
    
       public function action() {

        return view('admin.action');
    }
}
