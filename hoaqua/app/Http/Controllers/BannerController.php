<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slide;

class BannerController extends Controller
{
    // Phương thức hiển thị danh sách người dùng
    public function getBanList()
    {
        $slide = Slide::all();
        //dd($slide);
        return view('product.banner', compact('slide'));
    }

    public function getBanAdd()
    {
        $slide = Slide::all();
        return view('slide.add-banner',compact('slide'));
    }

    public function postBanAdd(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
             'link' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Store the slide data
        $slide = new Slide();
         $slide->link = $request->link;

        // Upload the image
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $destinationPath = public_path('slide');
            $file->move($destinationPath, $name);
            $slide->image = $name;
        }

        $slide->save();

        return redirect()->route('getBanList')->with('success', 'Thêm banner thành công');
    }

    public function getBanEdit($id)
    {
        $slide = Slide::find($id);
        return view('slide.edit-banner', compact('slide'));
    }

     public function postBanEdit(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'link' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Retrieve the slide based on the $id
        $slide = Slide::findOrFail($id);
        $slide->link = $request->link;
 
        // Upload the image if a new one is provided
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $destinationPath = public_path('slide');
            $file->move($destinationPath, $name);
            $slide->image = $name;
        }

        $slide->save();

        return redirect()->route('getBanList')->with('success', 'Cập nhật banner thành công');
    }

    public function getBanDelete($id)
    {
        $slide = Slide::findOrFail($id);
        $slide->delete();
        return redirect()->route('getBanList')->with('success', 'Xóa banner thành công');
    }
}