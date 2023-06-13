<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Bill;
use App\Models\BillDetail;
use App\Models\Category;
use App\Models\Cart;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use App\Models\User;
use App\Models\Slide;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Hash;
class PageController extends Controller
{
    public function index()
    {
        $new_product = Product::where('new', 1)->get();
        $products = Product::all();
        $categories = Category::all();
        $slides = Slide::all();
        View::share('slides', $slides);
        // Xóa dòng code sau vì không sử dụng biến $id nữa
        // $product = Product::find($id);
        return view('product.index', compact('new_product', 'products','categories'));
    }

    public function category($id)
    {
        $category = Category::findOrFail($id);
        $products = Product::where('id_type', $category->id)->get();
        $slides = Slide::all();
        $categories = Category::all(); 
        View::share('slides', $slides);
        return view('product.category', compact('category', 'products', 'categories'));
    }
    
    
    public function contacts()
    {
        $categories = Category::all(); 

        return view('product.contacts',compact('categories'));
    }
    
    public function about()
    {
        $categories = Category::all(); 

        return view('product.about',compact('categories'));
    }
    

    public function getProList()
    {
        $products = Product::all();
        return view('product.sanpham', ['products' => $products]);
    }

    public function getProAdd()
    {
        $categories = Category::all();
        //dd($categories);
        return view('product.them-sanpham', compact('categories'));
    }
    
    public function postProAdd(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'unit_price' => 'required',
            'new' => 'required',
            'unit' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $categoryName = $request->category; // Lấy tên danh mục từ form
        $category = Category::where('name', $categoryName)->first();
    
        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->unit_price = $request->unit_price;
        $product->new = $request->new;
        $product->unit = $request->unit;
     
        // Upload the image
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $destinationPath = public_path('product');
            $file->move($destinationPath, $name);
            $product->image = $name;
        }
        
        
        // Liên kết sản phẩm với danh mục tương ứng
        $product->category()->associate($category);
    
        $product->save();
        return redirect()->route('getProList')->with('success', 'Thêm sản phẩm thành công');
    }
    
    public function getProEdit($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
         return view('product.sua-sanpham', compact('product','categories'));
    }

    public function postProEdit(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'unit_price' => 'required',
            'new' => 'required',
            'unit' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $categoryId = $request->category; // Lấy ID danh mục từ form
    
        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->unit_price = $request->unit_price;
        $product->new = $request->new;
        $product->unit = $request->unit;
    
        // Upload the image
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $destinationPath = public_path('product');
            $file->move($destinationPath, $name);
            $product->image = $name;
        }
    
        // Liên kết sản phẩm với danh mục tương ứng
        $product->id_type = $categoryId;
    
        $product->save();
        return redirect()->route('getProList')->with('success', 'Sửa sản phẩm thành công');
    }
    
    public function getProDelete($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('getProList')->with('success', 'Xóa sản phẩm thành công');
    }
    
     

    public function show($id)
    {
        $categories = Category::all();
        $new_products = Product::where('new', 1)->get();
        $product = Product::findOrFail($id);
        $products = Product::all();
        return view('product.show', compact('product', 'products', 'new_products','categories'));
    }
    

    
    public function store(Request $request)
{
    // Xử lý request POST tới route /products ở đây
}
        //thêm 1 sản phẩm có id cụ thể vào model cart rồi lưu dữ liệu của model cart vào 1 session có tên cart (session được truy cập bằng thực thể Request)
        public function addToCart(Request $request,$id){
            $product=Product::find($id);
           
            $oldCart=Session('cart')?Session::get('cart'):null;
            $cart=new Cart($oldCart);
            $cart->add($product,$id);
            $request->session()->put('cart',$cart);
            return redirect()->back();

        }
    
    //thêm 1 sản phẩm có số lượng >1 có id cụ thể vào model cart rồi lưu dữ liệu của model cart vào 1 session có tên cart (session được truy cập bằng thực thể Request)
    public function addManyToCart(Request $request,$id){
        $product=Product::find($id);
        //dd($products);
        $oldCart=Session('cart')?Session::get('cart'):null;
        $cart=new Cart($oldCart);
        $cart->addMany($product,$id,$request->qty);
        $request->session()->put('cart',$cart);
       
        return redirect()->back();
    }     

    public function cartUpdate(Request $request, $id) {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
    
        $quantity = $request->quantity;
        $product = Product::find($id);
    
        $cart->updateItem($product, $id, $quantity); // Chuyển $product vào đây
    
        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        } 
    
        return redirect()->back();
    }
    
    
    

    
   
    
    public function removeFromCart($id)
    {
        $cart = Session::get('cart');
        
        if (isset($cart[$id])) {
            unset($cart[$id]);
            
            $newCart = new Cart($cart);
            $newCart->updateTotalPrice(); // Cập nhật lại tổng tiền
            
            Session::put('cart', $newCart);
        }
        
        return redirect()->route('cart');
    }
    
        
 

        // xóa sản phẩm
        public function delCartItem($id)
        {
            $oldCart = Session::has('cart') ? Session::get('cart') : null;
            $cart = new Cart($oldCart);
            $cart->removeItem($id);
        
            if (count($cart->items) > 0) {
                Session::put('cart', $cart);
            } else {
                Session::forget('cart');
            }       
            return redirect()->back();
        }
        
        public function shopping_cart()
        {
            $categories = Category::all();
            $cart = Session::get('cart');
            // Các xử lý khác...
            return view('product.shopping_cart', compact('cart', 'categories'));
        }
        
                 
         public function postshopping_cart()
         {
             return $this->shopping_cart();
         }
         
        public function checkout()
        {
            // Xử lý các nội dung liên quan đến thanh toán tại đây
            return view('product.checkout');
        }
     
        public function postCheckout(Request $request)
        {
            $validatedData = $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'address' => 'required',
                'phone_number' => 'required',
            ]);
        
            $cart = Session::get('cart');
        
            if (!$cart) {
                return redirect()->back()->with('error', 'Giỏ hàng trống');
            }
        
            $customer = new Customer();
            $customer->name = $validatedData['name'];
            $customer->gender = $request->input('gender');
            $customer->email = $validatedData['email'];
            $customer->address = $validatedData['address'];
            $customer->phone_number = $validatedData['phone_number'];
            $customer->note = $request->input('note');
            $customer->save();
        
            $bill = new Bill();
            $bill->id_customer = $customer->id;
            $bill->date_order = date('Y-m-d');
            $bill->total = $cart->totalPrice;
            $bill->payment = $request->input('payment_method');
            $bill->note = $request->input('note');
            $bill->save();
        
            foreach ($cart->items as $key => $value) {
                $bill_detail = new BillDetail();
                $bill_detail->id_bill = $bill->id;
                $bill_detail->id_product = $key;
                $bill_detail->quantity = $value['qty'];
                $bill_detail->unit_price = $value['price'] / $value['qty'];
                $bill_detail->save();
            }
        
            Session::forget('cart');
            return redirect()->back()->with('success', 'Đặt hàng thành công');
        }

        public function getSignin(){
            $categories = Category::all();
            return view('product.signup',compact('categories'));
        }
    
        public function postSignin(Request $req){
            $this->validate($req,
            ['email'=>'required|email|unique:users,email',
                'password'=>'required|min:6|max:20',
                'full_name'=>'required',
                'repassword'=>'required|same:password'
            ],
            ['email.required'=>'Vui lòng nhập email',
            'email.email'=>'Không đúng định dạng email',
            'email.unique'=>'Email đã có người sử  dụng',
            'password.required'=>'Vui lòng nhập mật khẩu',
            'repassword.same'=>'Mật khẩu không giống nhau',
            'password.min'=>'Mật khẩu ít nhất 6 ký tự'
            ]);
    
            $user=new User();
            $user->full_name=$req->full_name;
            $user->email=$req->email;
            $user->password=Hash::make($req->password);
            $user->phone=$req->phone;
            $user->address=$req->address;
            $user->id_level=3;  //level=1: admin; level=2:kỹ thuật; level=3: khách hàng
            $user->save();
            return redirect()->back()->with('success','Tạo tài khoản thành công');
        }
        
        
}
