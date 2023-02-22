<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
   public function profileView(Request $request, $id)
   {
    return redirect()->route('main.profile');
   }
}
