<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    //

    public function AllCat()
    {
        // 登録順から取得できる。
        // $categories =  Category::latest()->get();
        // $categories =  Category::latest()->paginate(3);


        // $categories = DB::table('categories')->latest()->get();
        $categories = DB::table('categories')->latest()->paginate(3);

        return view('admin.category.index', compact('categories'));
    }

    public function AddCat(Request $request)
    {
        $validated = $request->validate([
            'category_name' => 'required|unique:categories|max:255',
        ],[
            // エラーメッセージをアレンジできる。
            'category_name.required' => 'Please Input Category Name',
            'category_name.max' => 'Category Less Then 255Chars',
        ]);

         Category::insert([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id,
            'created_at' => Carbon::now()
         ]);
        
        // こっちでも登録できる。
        // retaed_atは自動的に入る
        // $category = new Category;
        // $category->category_name = $request->category_name;
        // $category->user_id = Auth::user()->id;
        // $category->save();

        /**
         * cretaed_atはnullになる
         */
        // $data = array();
        // $data['category_name'] = $request->category_name;
        // $data['user_id'] = Auth::user()->id;
        // DB::table('categories')->insert($data);

        return Redirect()->back()->with('success', ' Category Inserted Successfull');
    }
}
