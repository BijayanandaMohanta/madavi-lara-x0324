<?php

namespace App\Http\Controllers\Admin;

use App\Models\Seller;
// use App\Exports\SellerExport;
use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class SellerController extends Controller
{
    public function deleteregisteredsellers($id) {
        $data = Seller::findOrFail( $id );
        $data->delete();
        return redirect()->route('registeredsellers')->with('danger', 'Seller Deleted');
    }

    public function registeredsellers(){
        $sellers = Seller::latest()->get();
        return view('admin.sellers.registeredsellers', compact('sellers'));
    }

    public function update_seller_status(Request $request){
        $seller = Seller::find($request->seller_id);
        $seller->status =  ($seller->status == 1) ? 0 : 1;
        $seller->save();
        $success = 'success';
        return response()->json(['status' => $success]);
    }
}
