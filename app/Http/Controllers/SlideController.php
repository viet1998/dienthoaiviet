<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slide;
use Illuminate\Support\Facades\Auth;
use App\Models\History_change;
use Carbon\Carbon;

class SlideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slides=Slide::all();
        return view('admin.slide-admin',compact('slides'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        $this->validate($request,
            [
                'image'=>'required'
            ],
            [
                'image.required'=>'Vui lòng chọn ảnh để thêm!'
            ]);
        $slide=new Slide();
        $slide->last_modified_by_user=Auth::user()->id;
        $file=$request->file('image');
        $name=$file->getClientOriginalName();
        $destinationPath=public_path('/image/slide');
        $file->move($destinationPath,$name);
        $slide->image=$name;
        $slide->save();
        return redirect()->back()->with('thanhcong','Thêm slide mới thành công');
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
        $slide=Slide::find($id);
        $name=$slide->id;
        $slide->delete();
        $this->saveHistory("Delete",$id);
        return redirect()->back()->with('thanhcong','Xóa slide '.$name.' thành công');
    }

    public function saveHistory($method,$id){
        $history= new History_change;
        $history->table_change="Slide";
        $history->id_item=$id;
        $history->id_user=Auth::user()->id;
        $history->method=$method;
        $history->date_change=Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $history->save();
     }
}
