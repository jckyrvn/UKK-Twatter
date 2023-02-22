<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;


class UserController extends Controller
{
    public function index(){
        return view('auth.login');
    }
    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            "email"=>"required|email",
            "password"=>"required|min:8",
        ]);
        if($validator->fails()){
            
            return back()->withErrors(["message"=>"Login anda gagal"]);
        }
        $user = User::where('email', $request->email)->first();
        if($user == null)
        {
            return back()->withErrors(["message"=>"User Tidak ditemukan"]);;
        }
        if(Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('welcome');    
        }
    }
    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            "name"=>"required|max:255",
            "username"=>"required|min:3|unique:users",
            "email"=>"required|email|unique:users",
            "password"=>"required|min:8",
        ]);
        if($validator->fails()){
            return back()->withErrors(["message"=>"Register anda gagal"]);
        }
        $created = User::create(array_merge($validator->validated(), ["password"=> Hash::make($request->password)]));
        return redirect()->route('auth.login');
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('auth.login');
    }

    public function profileUpdate(Request $request){
        $format_media = "";
        $today = Carbon::now();
        if($request->hasFile('media')) {
            $storage = Storage::disk('profile_media');
            $format_media = $today->format('Ymd_Hms') . '_' . Str::random(12) . '_' . '.' . $request->file('media')->getClientOriginalExtension();
            $storage->putFileAs(null , $request->file('media') , $format_media, []);
        }

        $update = User::findOrFail($request->id_update);
        $update->name=$request->name_update;
        $update->username=$request->username_update;
        $update->bio=$request->bio;
        $update->media=$format_media;
        $update->save();
        
        return redirect("/");
    
        
    }
}
