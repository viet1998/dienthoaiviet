<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

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
}
