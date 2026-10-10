<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Conge;
use Illuminate\Http\Request;

class congeController extends Controller
{
    public function store(Request $request)
    {
        if($request->user()->role !== 'employe') {
            
        }
    }
}
