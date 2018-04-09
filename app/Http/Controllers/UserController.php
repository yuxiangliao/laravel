<?php

namespace App\Http\Controllers;

use App\Http\Models\Dictionary;
use App\Http\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //

    public function view(Request $request){
        //$user = User::where('Code','0000H')->get();
        //dd($user);
        //$user = User::find('0000H');
        /*$user->Name = 'liaoyuxiang';
        $user->save();
        */
        User::where('Code','0000H')->update(['Description'=>'liyuzhen']);
/*
        $newUser = new User;
        $newUser->Code = 'LIAO001';
        $newUser->Name = 'new customer';
        $newUser->PWD = '';
        $newUser->save();
*/
    }

    public function dic(Request $request)
    {
        $dictionary = Dictionary::where('TableName','SYS_PARAM')->where('Code','CURR_PROJECT')->get();
        dd($dictionary);
    }

    public function show($id){
        return view('user.profile',['username'=>$id]);
    }

    public function index(){
        $users = DB::select("select * from users");
        return view('user.index',['users'=>$users]);
    }

    public function action(Request $request,$action){
        if($request->has('name'))
            $name = $request->name;
        $male = $request->input('gender','male');
        $all = $request->all();
        return view('user.action',['name'=>$name,'action'=>$action.$male,'all'=>$all]);
    }
    public function testCookie(Request $request){
        $value = $request->cookie('name');
        return response('欢迎来到 Laravel 学院')->cookie(
            'name', '学院君', $minutes
        );
    }


}
