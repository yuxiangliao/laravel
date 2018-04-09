<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\User;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;
use Psy\Test\Exception\RuntimeExceptionTest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;

class IndexController extends CommonController
{
    public function index(Request $request){
        return view('admin.index');
    }

    public function info(Request $request){
        return view('admin.info');
    }

    public function pass(Request $request){
        if($request->isMethod('post')){
            $input = $request->all();
            $rule = [
                'password' => 'required|between:6,20|confirmed',
                'password_confirmation' => 'required',
                'password_o' => 'required',
            ];
            $message = [
                'password.required' => '新密码不能为空',
                'password_confirmation.required' => '重复密码不能为空',
                'password.confirmed' => '新密码与重复密码不同',
                'password.between' => '新密码必须在6位和20位之间',
                'password_o.required' => '旧密码不能为空',
            ];

            $validatedData = Validator::make($input,$rule,$message);
            if($validatedData->fails()) {
                return back()->withErrors($validatedData);
            }
            $username = session('user');

            $user = User::find($username);
            if(!$user){
                //$validatedData->errors->add('key','用户不存在');
                return redirect('admin\login');
            }
            $old_pass = Crypt::decrypt($user->PWD);
            if ($old_pass!= $request->input('password_o')){
                $validatedData->errors()->add('key','旧密码不正确');
                return back()->withErrors($validatedData);
            }
            $user->PWD = Crypt::encrypt($request->input('password'));
            $user->update();

            $validatedData->errors()->add('key','密码修改成功');
            return back()->withErrors($validatedData);

        }
        else
            return view('admin.pass');
    }
}
