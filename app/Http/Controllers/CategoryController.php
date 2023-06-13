<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Level;
use  App\Models\User;

class CategoryController extends Controller
{
    // Phương thức hiển thị danh sách các mục danh mục
    public function getCateList()
    {
        $categories = Category::all();
        //dd($categories);
        return view('product.danhsach', ['categories' => $categories]);
    }

    // Phương thức hiển thị form thêm mới mục danh mục
    public function getCateAdd()
    {
        
        return view('product.cate-add');
    }

    // Phương thức xử lý thêm mới mục danh mục
    public function postCateAdd(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Store the category data
        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;

        // Upload the image
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $destinationPath = public_path('category');
            $file->move($destinationPath, $name);
            $category->image = $name;
        }

        $category->save();

        return redirect('/products/category/danhsach')->with('success', 'Thêm mục danh mục thành công');
    }

    // Phương thức hiển thị form sửa mục danh mục
    public function getCateEdit($id)
    {
        $category = Category::find($id);
        return view('product.cate-edit', compact('category'));
    }

    // Phương thức xử lý cập nhật mục danh mục
    public function postCateEdit(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Retrieve the category based on the $id
        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->description = $request->description;

        // Upload the image if a new one is provided
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $destinationPath = public_path('category');
            $file->move($destinationPath, $name);
            $category->image = $name;
        }

        $category->save();

        return redirect('/products/category/danhsach')->with('success', 'Cập nhật danh mục thành công');
    }

    // Phương thức xử lý xóa mục danh mục
    public function getCateDelete($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect('/products/category/danhsach')->with('success', 'Xóa danh mục thành công');
    }
 
}
