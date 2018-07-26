<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends CommonController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $cate = Category::getInstance();
        $data = $cate->tree();

        return view('admin.category.index')->with('data',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data = Category::all()->where('cate_pid',0);
        return view('admin.category.add')->with("data",$data);
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->except('_token');
        $rules = [
            'cate_name'=>'required',
        ];

        $message = [
            'cate_name.required'=>'分类名称不能为空！',
        ];

        $validator = Validator::make($input,$rules,$message);

        if($validator->passes()){
            $re = Category::create($input);
            if($re){
                return redirect('admin/category');
            }else{
                return back()->with('errors','数据填充失败，请稍后重试！');
            }
        }else{
            return back()->withErrors($validator);
        }
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $cate,$id)
    {
        $data = Category::find($id);
        $category = Category::where('cate_pid',0)->get();

        return view('admin.category.edit',[
            'field'=>$data,
            'data'=>$category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      die("okok");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $cate,$id)
    {
         $rst = $cate::where('cate_id',$id)->delete();
         if($rst){
             $resultArr = [
                 "state"=>"0",
                 "msg"=>"删除成功"
             ];
         }
         return json_encode($resultArr);
    }

    public function changeOrder(Request $request)
    {
        $id = $request->input('cate_id');
        $object = Category::find($id);
        $object->order = $request->input('cate_order');
        $object->update();
    }
}
