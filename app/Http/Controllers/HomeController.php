<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Image;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function HomeSlider()
    {
        $sliders = Slider::latest()->paginate(3);
        return view('admin.slider.index', compact('sliders'));
    }

    public function AddSlider()
    {
        return  view('admin.slider.create');
    }


    public function StoreSlider(Request $request)
    {

        $validated = $request->validate([
            'title' => 'required|unique:sliders|min:4',
            'description' => 'required|max:200',
            'image' => 'required|mimes:jpg,png,jpeg',
        ], [
            'title.required' => 'Please Input Brand Name',
            'title.min' => 'brand longer then 4Chars',
        ]);

        // ファイルを取り出すときはfileメソッドを使用
        $slider_image = $request->file('image');
        $up_location = 'image/slider/';

         // ライブラリを使ってリサイズを行う場合
        $name_gen = hexdec(uniqid()).'.'.$slider_image->getClientOriginalExtension();
        $last_img = $up_location.$name_gen;
        Image::make($slider_image)->resize(1920, 1088)->save($last_img);
 
        Slider::insert([
             'title' => $request->title,
             'description' => $request->description,
             'image' => $last_img,
             'created_at' => Carbon::now()
        ]);
 
        return Redirect()
            ->route('home.slider')
            ->with('success', 'Slider Inserted Succesfully');
    }
}
