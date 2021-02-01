<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Support\Facades\Hash;

use Collective\Html\FormFacade as Form;
use Illuminate\Support\Facades\Auth;
use App\Models\History_change;
use Carbon\Carbon;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::paginate(10);
        return view('admin.user.user_admin',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.add_user_admin');
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
                'email'=>'required|email|unique:users,email',
                'password'=>'required|min:6|max:20',
                'full_name'=>'required',
                'phone'=>'required|unique:users,phone',
                'level'=>'required'
            ],
            [
                'email.required'=>'Vui lòng nhập Email',
                'email.email'=>'Không dúng định dạng Email',
                'email.unique'=>'Email đã có người sử dụng',
                'password.required'=>'Vui lòng nhập mật khẩu',
                'password.min'=>'Mật khẩu ít nhất 6 ký tự',
                'password.max'=>'Mật khẩu nhiều nhất 20 ký tự',
                'full_name.required'=>'Vui lòng nhập họ tên',
                'phone.required'=>'Vui lòng nhập số điện thoại',
                'phone.unique'=>'Số điện thoại đã được sử dụng',
                'level.required'=>'Vui lòng chọn quyền truy cập',
            ]);
        $user=new User();
        $user->full_name=$request->full_name;
        $user->email=$request->email;
        $user->password=Hash::make($request->password);
        $user->level=$request->level;
        $user->phone=$request->phone;
        $user->address=$request->address;
        $user->save();
        return redirect()->back()->with('thanhcong','Tạo tài khoản thành công');
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
        $user= User::find($id);
        return view('admin.user.edit_user_admin',compact('user'));
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
                'full_name'=>'required',
                'phone'=>'required',
                'level'=>'required'
            ],
            [
                'full_name.required'=>'Vui lòng nhập họ tên',
                'phone.required'=>'Vui lòng nhập số điện thoại',
                'level.required'=>'Vui lòng chọn quyền truy cập',
            ]);
        
        $user=User::find($id);
        $user->full_name=$request->full_name;
        $user->level=$request->level;
        $user->phone=$request->phone;
        $user->address=$request->address;
        $user->last_modified_by_user=Auth::user()->id;
        $user->update();
        saveHistory("Update",$id);
        return redirect()->back()->with('thanhcong','Sửa tài khoản thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user=User::find($id);
        $email=$user->email;
        if($user->level==0)
            return redirect()->back()->with('thatbai','Tạm thời không thể xóa tài khoản khách hàng');
        else{
            $user->delete();
            saveHistory("Delete",$id);
            return redirect()->back()->with('thanhcong','Xóa tài khoản '.$email.' thành công');
        }
    }

    public function showLogin(){
        return view('user.login');
    }
    public function showSigup(){
        return view('user.sigup');
    }
     
    public function showProfileUser(){
        return view('user.profile');
    } 

    public function getSortUser($id)
    {
        
        switch ($id) {
            case 1:
                $users=User::orderBy('full_name')->get();
                break;

            case 2:
                $users=User::orderBy('email')->get();
                break;

            case 3:
                $users=User::where('level',0)->get();
                break;

            case 4:
                $users=User::where('level',1)->get();
                break;

            case 5:
                $users=User::where('level',2)->get();
                break;

            
            
            default:
                # code...
                break;
        }
        foreach($users as $key => $user)
         { $this->showUserToHtml($user,$id); } 
         // return $users;
        // return view('page.quanly.timkiemsanpham',compact('users','request')); onclick="return  confirm('Có xóa '+<?php $user['name']+' không?');"
    }

    public function getSearchUser($searchname)
    {
        $users=User::where('full_name','like','%'.$searchname.'%')
        ->orWhere('email','like','%'.$searchname.'%')
        ->orWhere('phone','=',$searchname)
        ->orWhere('id','=',$searchname)
        ->orWhere('last_modified_by_user','=',$searchname)
        ->get();
        if($searchname=='null')
            $users=User::all();
        foreach($users as $key => $user)
        { $this->showUserToHtml($user,0); } 
    }

    public function showUserToHtml($user,$id){
        ?>
        <tr>
        <td><?php echo $user['id'] ?></td>
        <td><?php echo $user['full_name'] ?></td>
        <td><?php echo $user['email'] ?></td>
        <td><?php echo $user['phone'] ?></td>
        <td><?php echo $user['address'] ?></td>
        <td>
            <?php
            switch ($user->level) {
                case 0:
                    echo 'Khách Hàng';
                    break;

                case 1:
                    echo 'Nhân Viên';
                    break;

                case 2:
                    echo 'Quản Lý';
                    break;
                
                default:
                    # code...
                    break;
            }
            ?>
        </td>
        <td><?php if(isset($user['last_modified_by_user'])) echo $user['last_modified_by_user'].' - '.$user['parent']['full_name'] ?></td>
        <td><?php echo $user['created_at'] ?></td>
        <td><?php echo $user['updated_at'] ?></td>
        <td>
            <?php echo Form::open(array('route' => ['user.destroy',$user['id']], 'method' => 'delete')); ?>
            <?php Form::token() ?>
            <a href="<?php echo route('user.edit',$user['id']); ?>" class="btn btn-primary">Sửa</a>
            <?php echo Form::submit('Xóa',['class'=>'btn btn-primary','onclick'=>'return confirm("Có xóa '.$user['email'].' không?")']); ?>
            <?php echo Form::close(); ?>
        </td>
        </tr>
        <?php
     }

     public function saveHistory($method,$id){
        $history= new History_change;
        $history->table_change="User";
        $history->id_item=$id;
        $history->id_user=Auth::user()->id;
        $history->method=$method;
        $history->date=Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $history->save();
     }
}
