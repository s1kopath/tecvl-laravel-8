<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;


class CustomerPanelController extends Controller
{
    public function index()
    {
        return view('admin.customer.customer_panel');
    }

}
