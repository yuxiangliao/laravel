<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\User;
use Illuminate\Http\Request;
use \App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;


class AdminController extends Controller
{
    //
    public function login(Request $request){

        if($request->isMethod('post')){
            if(!$request->has('user_name')){
                $res = "验证码不能为空";
                return back()->with('msg',$res);
            }
            if(!$request->has('user_pass')){
                $res = "验证码不能为空";
                return back()->with('msg',$res);
            }
            if(!$request->has('code')){
                $res = "验证码不能为空";
                return view("admin.login",compact('res','title','sql','kouhao'));
            }
            $code =strtoupper($request->input('code'));
            if($code != self::getcode()){
                $res = "验证码错误";
                return back()->with(['msg'=>$res]);
            }
            $username = $request->input('user_name');
            $pwd = $request->input('user_pass');
            $user = User::find($username);
            if(!$user)
                return back()->with('msg','用户不存在');
            if(decrypt($user->PWD) == $pwd){
                session(['user'=>$username]);
                return redirect('admin/index');
            }

        }else{
            session(['user'=>null]);

        }
        return view("admin.login",compact('res','title','sql','kouhao'));
    }

    public function jiami(Request $request){

        $str = '123456';
        $encode = Crypt::encrypt($str);
        echo $encode;
    }

    public function code(Request $request){
        $code = new \Code;
        $code->make();
    }

    public function getcode(){
        $code = new \Code;
        return $code->get();
    }

    public function quit(Request $request){
        session(['user'=>null]);
        return redirect('admin/login');
    }
}
