<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\User;
use Socialize;
use Hash;
use DB;

class UserController extends Controller
{
    public function login(Request $request){
        $email = $request->input('email');
        $password = $request->input('password');
        if(Auth::attempt(['email'=>$email,'password'=>$password])){
            //correct email and password
            return redirect('/');
        }
        else{
            //gagal login
            return redirect('/login')->with('error','Invalid username or password');
        }
    }
    public function loginForm(){
         if(!Auth::check())
           return view('home.login');
        else
            return redirect('/');
    }
    public function registerForm(){
         if(!Auth::check())
           return view('home.register');
        else
            return redirect('/');
    }
    public function register(Request $request){
        $name = $request->input('name');
        $password = $request->input('password');
        $email = $request->input('email');
        $domisili = $request->input('domicile');
        $phone = $request->input('phone');
        $user = new User();
        $user->name = $name;
        $user->domicile = $domisili;
        $user->phone = $phone;
        $user->email = $email;
        //validate first!
        $validator1 = Validator::make($request,[
            'email' => 'email',
        ],['email'=>'Email address is not in valid format']);
        $validator2 = Validator::make($request,[
            'phone' => 'numeric',
        ],['phone'=>'Only numbers allowed']);
        $validator3 = Validator::make($request,[
            'name' => 'min:3',
        ],['name'=>'Your name must be 3 characters or more']);
        if ($validator1->fails()) {
            return redirect('/register')
                    ->withErrors($validator3);
        }
        if ($validator2->fails()) {
            return redirect('/register')
                    ->withErrors($validator2);
        }
        $user->password = Hash::make($password);
        $user->save();
        Auth::loginUsingId($user->id);
        return redirect('/');
        //
    }
    public function google(){
        if(!Auth::check())
            return Socialize::driver('google')->redirect();
        return redirect('/');
    }
    public function facebook(){
        if(!Auth::check())
            return Socialize::driver('facebook')->redirect();
        return redirect('/');
    }
    public function googleCallBack(){
        $user = Socialize::driver('google')->user();
        $name = $user->name;
        $email = $user->email;
        $user = User::where('email','=',$email)->first();
        if(!$user){
            //kalau user tidak ditemukan dalam database, buat user baru
            $user = new User();
            $user->name = $name;
            $user->email = $email;
            $user->save();
        }
        Auth::loginUsingId($user->id);
        return redirect('/');
    }
    public function facebookCallBack(){
        $user = Socialize::driver('facebook')->user();
        $name = $user->name;
        $email = $user->email;
        $user = User::where('email','=',$email)->first();
        if(!$user){
            $user = new User();
            $user->name = $name;
            $user->email = $email;
            $user->save();
        }
        Auth::loginUsingId($user->id);
        return redirect('/');
    }
    public function logout(){
        Auth::logout();
        return redirect('/');
    }
    public function showProfile(){
        if(Auth::check())
        {
            //ambil segala data user
            $user = Auth::user();
            $idDom = $user->domicile;
            $domicile = DB::table('domicile')->select('location')->where('id',$idDom)->first();
            if( $idDom == 0 ){
                //belum set domisili
                $domicile = 'Belum memilih domisili';
            }
            else
                $domicile = $domicile->location;
            return view('profile',['user'=>$user,'domicile'=>$domicile]);
        }
        else
            return redirect('/login')->with('error','You must be logged in first!');
    }
    public function createAdoption(){
        if(Auth::check())
        {
            $user = Auth::user();
            $userId = $user->id;
            $adList = DB::table('adoptions')
                ->join('domicile','adoptions.domicile','=','domicile.id')
                ->where('adoptions.user_id',$userId);
            return view('userAdoption',['adoptions'=>$adList]);     
        }
        else
            return redirect('login')->with('error','You must be logged in first!');
        
    }
    public function saveAdoption(Request $request){
        if(Auth::check()){
            $user = Auth::user();
            $userId = $user->id;
            $adoption = new Adoption();
            //buat adopsi baru
        }
        else{
            return redirect('login')->with('error','You must be logged in first!');
        }
    }
    public function listAdoptions(){
        return 'haha';
    }
    public function markDone($id){
        //menandai bahwa adopsi untuk adoption pada suatu user sudah "done"
        $user = Auth::user();
        $userId = $user->id;
        $adoption = DB::table('adoptions')
            ->where('user_id',$userId)
            ->where('id',$id)
            ->update(['done'=>1]);
        return redirect('/adoption/create')->with('status','Adoption marked as done!');
    }
}
