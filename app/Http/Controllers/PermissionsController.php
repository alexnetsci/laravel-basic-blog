<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PermissionsController extends Controller
{
    public function permissionDenied() {
        return view('permission-denied');
    }
}