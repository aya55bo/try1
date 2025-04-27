<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transport;

class TransportController extends Controller
{
    public function index()
    {
        $transports = Transport::paginate(10);
        return view('transport', compact('transports'));
    }
}