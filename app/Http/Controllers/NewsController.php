<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\News;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news=News::paginate(10);
        return view('admin.news.news-admin',compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.news.add-news-admin');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,
            [
                'title'=>'required',
                'image'=>'required',
                'content'=>'required'
            ],
            [
                'image.required'=>'Vui lòng chọn ảnh để thêm!',
                'title.required'=>'Vui lòng nhập tiêu đề!',
                'content.required'=>'Vui lòng nhập nội dung bài viết!'
            ]);
        $news=new News();
        $news->title=$request->title;
        $news->content=$request->content;
        $news->last_modified_by_user=Auth::user()->id;
        $news->created_by_user=Auth::user()->id;
        $file=$request->file('image');
        $name=$file->getClientOriginalName();
        $destinationPath=public_path('/image/news');
        $file->move($destinationPath,$name);
        $news->image=$name;
        $news->save();
        return redirect()->back()->with('thanhcong','Thêm bài viết mới thành công');
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
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $news= News::find($id);
        $name= $news->title;
        $news->delete();
        return redirect()->back()->with('thanhcong','Xóa bài viết '.$name.' thành công');
    }
}
