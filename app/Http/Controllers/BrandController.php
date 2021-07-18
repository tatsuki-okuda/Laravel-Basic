<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Image;

class BrandController extends Controller
{
    /**
     * brand index
     *
     * @return void
     */
    public function AllBrand()
    {
        $brands = Brand::latest()->paginate(5);
        return view('admin.brand.index', compact('brands'));
    }


    /**
     * add new Brand
     * 画像のアップロード
     *
     * @param Request $request
     * @return void
     */
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

        // デフォルトで画像を保存する場合
        // // uniqid() 一位なID
        // // hexdec 16 進数を 10 進数に変換する
        // $name_gen = hexdec(uniqid());
        // // ファイル拡張し
        // $img_ext = strtolower($brand_image->getClientOriginalExtension());
        // // ファイル名を作成
        // $img_name = $name_gen.'.'.$img_ext;

        $up_location = 'image/brand/';
        // $last_img = $up_location.$img_name;
        // // 指定のファイルに移動させる。
        // $brand_image->move($up_location, $img_name);

        // ライブラリを使ってリサイズを行う場合
        $name_gen = hexdec(uniqid()).'.'.$brand_image->getClientOriginalExtension();
        $last_img = $up_location.$name_gen;
        Image::make($brand_image)->resize(300, 200)->save($last_img);



        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_image' => $last_img,
            'created_at' => Carbon::now()
         ]);

         return Redirect()
            ->back()
            ->with('success', 'Brand Inserted Succesfully');
    }



    /**
     * Brand Edit
     *
     * @param [type] $id
     * @return void
     */
    public function Edit($id)
    {
        $brand = Brand::find($id);
        return view('admin.brand.edit', compact('brand'));
    }


    /**
     * Brand Update
     *
     * @param Request $request
     * @param [type] $id
     * @return void
     */
    public function Update(Request $request, $id)
    {
        $validated = $request->validate([
            'brand_name' => 'min:4',
            'brand_image' => 'mimes:jpg,png,jpeg',
        ], [
            // エラーメッセージをアレンジできる。
            'brand_name.required' => 'Please Input Brand Name',
            'brand_name.min' => 'brand longer then 4Chars',
        ]);

        // hiddenで入れた古いファイル名を取得する。
        $old_image = $request->old_image;
        $brand_image = $request->file('brand_image');

        if($brand_image){
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($brand_image->getClientOriginalExtension());
            $img_name = $name_gen.'.'.$img_ext;
            $up_location = 'image/brand/';
            $last_img = $up_location.$img_name;
            $brand_image->move($up_location, $img_name);

            unlink($old_image);
            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'brand_image' => $last_img,
                'created_at' => Carbon::now()
            ]);

        } else {
            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'created_at' => Carbon::now()
            ]);
        }

        return Redirect()
                ->back()
                ->with('success', 'Brand Inserted Succesfully');        
    }


    public function Delete($id)
    {
        $brand =  Brand::find($id);
        $old_image = $brand->brand_image;
        unlink($old_image);

        $brand->delete();

        return Redirect()
                ->back()
                ->with('success', 'Brand Deleted Succesfully');    
    }

}
