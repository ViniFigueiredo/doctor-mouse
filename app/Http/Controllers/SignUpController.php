<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class SignUpController extends Controller
{
    public function store(Request $request)
    {
        $campos = $request->all();

        Log::info($campos);
        
        return redirect("/")->with("status", "Signed In!");
    }
}
