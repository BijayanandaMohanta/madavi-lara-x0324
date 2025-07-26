<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Models\ProductStock;
use Illuminate\Http\Request;
use App\Models\Notify;
use App\Models\Customer;
use App\Http\Controllers\HelperController;
use Illuminate\Support\Str;


class ProductStockController extends Controller
{
    //
    public function index()
    {
        $data = Product::orderby('created_at', 'DESC')->get();
        return view('admin.product_image.index', compact('data'));
    }


    public function edit($id)
    {
        $data = ProductStock::where('product_id', $id)->orderby('created_at', 'DESC')->get();
        $product_data = Product::Where('id', $id)->first();

        return view('admin.product_stock.edit', compact('data', 'product_data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'stock' => 'required|numeric', // Adjust validation rules as needed
            'product_id' => 'required',
            'type' => 'required'
        ]);

        $product_data = Product::where('id', $request->product_id)->first();

        if ($request->type == 'Debit' && $request->from == 'AJAX' && $product_data->stock < $request->stock) {
            return response()->json(['success' => 'Stock is not sufficient to debit']);
        }   
        if ($request->type == 'Debit' && $product_data->stock < $request->stock) {
            return redirect()->back()->with('danger', 'Stock is not sufficient to debit');
        }

        if ($request->type == 'Credit') {
            $balance = $product_data->stock + $request->stock;
            $remark = $request->stock . '' . " Credited As Admin Added The stock";
        } else {
            $balance = $product_data->stock - $request->stock;
            $remark = $request->stock . '' . " Debited As Admin Deduct From The stock";
        }
        $product_data->stock = $balance;
        $product_data->save();

        $stock = new ProductStock();
        $stock->type = $request->type;
        $stock->stock = $request->stock;
        $stock->remark = $remark;
        $stock->product_id = $request->product_id;
        $stock->save();

        // Product stock
        $product_update_record = Product::where('id', $request->product_id)->first();


        $notify1 = Notify::where('product_id',$request->product_id)->orderBy('created_at', 'desc')->get();

foreach ($notify1 as $notify) {
    $suc_data = Customer::where('id', $notify->customer_id)->first();
    $email = $suc_data->email;
    $sub = "🎉 {$product_update_record->name} is Back in Stock! Order Now Before It’s Gone";

    $link = "https://openboxwale.in/product/{$product_update_record->slug}";
    $msg = "Dear {$suc_data->name},<br><br>

Good news! The item you’ve been waiting for, [{$product_update_record->name}], is back in stock. Don’t wait too long—this popular item tends to sell out quickly!<br><br>

Click the link below to order now:<br>
<a href=\"{$link}\">👉 Order [{$product_update_record->name}]</a><br>

Secure yours today before it’s gone again. We’re excited to serve you!<br>

Thank you for choosing OpenBoxWale.<br><br>

Best regards,<br>
Team OpenBoxWale";
    (new HelperController)->sendZohoEmail($sub, $msg, $suc_data->name ?? 'User', $suc_data->email);
}

    Notify::where('product_id', $request->product_id)->delete();



        // Redirect back with success message
        if ($request->from == 'AJAX') {
            return response()->json(['success' => 'Stock Updated successfully','product_stock' => $product_update_record->stock]);
        }
        return redirect()->back()->with('success', 'Stock Updated successfully');
    }
}
