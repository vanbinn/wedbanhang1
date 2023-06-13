<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Level;
use App\Models\Category;

class UserController extends Controller
{
    // Phương thức hiển thị danh sách người dùng
    public function getUserList()
    {
        $categories = Category::all();
        $level = Level::all();
       //dd($level);
        $users = User::all();
        return view('product.nguoidung', compact('users','categories','level'));
    }

    // Phương thức hiển thị form thêm mới người dùng
    public function getUserAdd()
    {
        $level = Level::all();
        return view('product.them-nguoidung',compact('level'));
    }

    // Phương thức xử lý thêm mới người dùng
    public function postUserAdd(Request $request)
    {
        $request->validate([
            'full_name' => 'required',
            'email' => 'required|unique:users,email', // Thêm ràng buộc unique vào đây
            'password' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);
        
        $user = new User();
        $user->full_name = $request->full_name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->phone = $request->phone;
        $user->address = $request->address;
    
        $user->save();
    
        return redirect()->route('getUserList')->with('success', 'Thêm người dùng thành công');
    }
    

    // Phương thức hiển thị form sửa người dùng
    public function getUserEdit($id)
    {
        $user = User::find($id);
        $levels = Level::all();
        return view('product.sua-nguoidung', compact('user','levels'));
    }

    public function postUserEdit(Request $request, $id)
    {
        $request->validate([
            'full_name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);
        
        $levelID = $request->level->id; // Lấy ID danh mục từ form

        $user = User::findOrFail($id);
        $user->full_name = $request->full_name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->phone = $request->phone;
        $user->address = $request->address;
        
        // Lấy ID danh mục từ form
        $user->id_level = $levelID;
        
        $user->save();
        return redirect()->route('getUserList')->with('success', 'Cập nhật người dùng thành công');
    }

    // Phương thức xử lý xóa người dùng
    public function getUserDelete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('getUserList')->with('success', 'Xóa người dùng thành công');
    }

    public function getLogin()
    {
        $categories = Category::all();
        //dd($categories);
        return view('product.login', compact('categories'));
    }

    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6|max:20'
        ], [
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Không đúng định dạng email',
            'email.unique' => 'Email đã có người sử dụng',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Mật khẩu ít nhất 6 ký tự'
        ]);

        $credentials = array('email' => $request->email, 'password' => $request->password);

        if (Auth::attempt($credentials)) {
            return redirect()->route('getCateList')->with(['flag' => 'alert', 'message' => 'Đăng nhập thành công']);
        
        
        } else {
            return redirect()->back()->with(['flag' => 'danger', 'thongbao' => 'Đăng nhập không thành công']);
        }
    }

    public function getLogout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('product.login');
    }
}
