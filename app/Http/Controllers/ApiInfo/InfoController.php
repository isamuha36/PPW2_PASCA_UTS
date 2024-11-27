<?php

namespace App\Http\Controllers\ApiInfo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InfoController extends Controller
{
    public function index()
    {
        return response()->json(['message' => 'Hello World', 'success' => true], 200);
    }
    
}
