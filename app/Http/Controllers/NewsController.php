<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use Collective\Html\FormFacade as Form;
use App\Models\News;
use App\Models\History_change;
use Carbon\Carbon;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news=News::orderBy('id','DESC')->paginate(10);
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
        $news=News::find($id);
        return view('admin.news.edit_news',['news'=>$news]);

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
        $this->validate($request,
            [
                'title'=>'required',
                'content'=>'required'
            ],
            [
                'title.required'=>'Vui lòng nhập tiêu đề!',
                'content.required'=>'Vui lòng nhập nội dung bài viết!'
            ]);
        $news=News::find($id);
        $news->title=$request->title;
        $news->content=$request->content;
        $news->last_modified_by_user=Auth::user()->id;
        $file= null;
        $name=null;
        if($request->hasFile('image'))
        {
            $file=$request->file('image');
            $name=$file->getClientOriginalName();
            $destinationPath=public_path('/image/news');
            $file->move($destinationPath,$name);
            $news->image=$name;
        }
        $news->save();
        $this->saveHistory("Update",$id);
        return redirect()->back()->with('thanhcong','Sửa bài viết mới thành công');
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
        if(Auth::user()->id!=$news->created_by_user && Auth::user()->level<2 )
            return redirect()->back()->with('thatbai','Chỉ có tác giả hoặc quản lý được quyền xóa bài này!');
        $news->delete();
        $this->saveHistory("Delete",$id);
        return redirect()->back()->with('thanhcong','Xóa bài viết '.$name.' thành công');
    }

    public function getSearchNews($searchname){
        if($searchname=='null')
            $news=News::all();
        else
            $news=News::where('title','like','%'.$searchname.'%')
            ->orWhere('id','=',$searchname)
            ->orWhere('created_at','=',$searchname)
            ->orWhere('updated_at','=',$searchname)
            ->orWhere('last_modified_by_user','=',$searchname)
            ->orWhere('created_at','=',$searchname)
            ->get();
        foreach($news as $n)
        {
        $this->showNewsToHtml($n);
        } 
    }

    public function showNewsToHtml($news){
        ?>
        <tr>
        <td><?php echo $news['id']; ?></td >
        <td><img src="/image/news/<?php echo $news['image']; ?>" width="140px" height="80px"></a></td>
        <td><?php echo $news['title']; ?></td>
        <td><?php echo $news['created_by_user']; ?> - <?php echo $news['user']['full_name']; ?></td>
        <td><?php echo $news['last_modified_by_user']; ?> - <?php echo $news['user_modified']['full_name']; ?></td>
        <td><?php echo $news['created_at']; ?></td>
        <td><?php echo $news['updated_at']; ?></td>
        <td style="width: 150px">
        <?php echo Form::open(array('route' => ['news.destroy',$news['id']], 'method' => 'delete')); ?>
            <?php Form::token() ?>
            <a href="<?php echo route('news.edit',$news['id']); ?>" class="btn btn-primary"><span class="glyphicon glyphicon-edit white"></span></a>
            <?php echo Form::submit('Xóa',['class'=>'btn btn-danger','onclick'=>'return confirm("Bạn có chắc chắn xóa bài viết '.$news['title'].' không?")']); ?>
        <?php echo Form::close(); ?>
        </td>
        </tr>
        <?php
     }
    public function saveHistory($method,$id){
        $history= new History_change;
        $history->table_change="News";
        $history->id_item=$id;
        $history->id_user=Auth::user()->id;
        $history->method=$method;
        $history->date_change=Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $history->save();
     }
}
