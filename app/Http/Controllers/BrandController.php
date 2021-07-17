<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BrandController extends Controller
{
    
    public function AllBrand()
    {
        $brands = Brand::latest()->paginate(5);
        return view('admin.brand.index', compact('brands'));
    }


    public function StoreBrnad(Request $request)
    {
        $validated = $request->validate([
            'brand_name' => 'required|unique:brands|min:4',
            'brand_image' => 'required|mimes:jpg,png,jpeg',
        ], [
            // エラーメッセージをアレンジできる。
            'brand_name.required' => 'Please Input Brand Name',
            'brand_name.min' => 'brand longer then 4Chars',
        ]);

        // ファイルを取り出すときはfileメソッドを使用
        $brand_image = $request->file('brand_image');

        // uniqid() 一位なID
        // hexdec 16 進数を 10 進数に変換する
        $name_gen = hexdec(uniqid());
        // ファイル拡張し
        $img_ext = strtolower($brand_image->getClientOriginalExtension());
        // ファイル名を作成
        $img_name = $name_gen.'.'.$img_ext;

        $up_location = 'image/brand/';
        $last_img = $up_location.$img_name;
        // 指定のファイルに移動させる。
        $brand_image->move($up_location, $img_name);

        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_image' => $last_img,
            'created_at' => Carbon::now()
         ]);

         return Redirect()
            ->back()
            ->with('success', 'Brand Inserted Succesfully');
    }

}
