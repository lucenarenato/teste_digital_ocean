<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
  $response = compact('token');
  $response['user'] = Auth::user();
  return response()->json($response);
}
