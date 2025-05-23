<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\ProductLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class productController extends Controller
{
    public function index(){
        $products = Product::all();
        return view("products.index_products",compact("products"));
    }
    public function store(Request $request){
        $request->validate([
            'product_name' => 'required|string|max:255',
            'product_category' => 'required|string',
            'product_quantity' => 'required|integer|min:1',
            'product_price' => 'required|numeric|min:0',
            'product_description' => 'nullable|string',
        ]);
        Product::create([
            'name'=> $request->product_name,
            'category' => $request->product_category,
            'quantity'=> $request->product_quantity,
            'price'=> $request->product_price,
            'description'=> $request->product_description,
        ]);
        return redirect()->route('product.index' );
    }
   

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }
    public function update(Request $request, $id){
        $product = Product::findOrFail($id);
        $request->validate([
        'product_name' => 'required|string|max:255',
        'product_category' => 'required|string',
        'product_quantity' => 'required|integer|min:1',
        'product_price' => 'required|numeric|min:0',
        'product_description' => 'nullable|string',
    ]);
        $product->update([
        'name' => $request->product_name,
        'category' => $request->product_category,
        'quantity' => $request->product_quantity,
        'price' => $request->product_price,
        'description' => $request->product_description,
    ]);
    return redirect()->route('product.index')->with('success', 'Sản phẩm đã được cập nhật!');

    }
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('product.index')->with('success', 'Sản phẩm đã được xóa!');
    }

    public function showLogs()
    {
        $logs = ProductLog::orderBy('performed_at', 'desc')->paginate(20);
        return view('products.productLogs', compact('logs'));
    }


    // doanh thu
    public function doanhthu(){
        // Doanh thu hôm nay
    $doanhThuHomNay = DB::table('customers')
        ->whereDate('updated_at', now()->toDateString())
        ->sum('price');

    // Doanh thu tháng này
    $doanhThuThangNay = DB::table('customers')
        ->whereYear('updated_at', now()->year)
        ->whereMonth('updated_at', now()->month)
        ->sum('price');

    // Doanh thu năm nay
    $doanhThuNamNay = DB::table('customers')
        ->whereYear('updated_at', now()->year)
        ->sum('price');

        return view('doanhthu', compact('doanhThuThangNay', 'doanhThuHomNay', 'doanhThuNamNay'));
    }

}
