<?php

namespace App\Http\Controllers;

use App\Models\HomeAbout;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AboutController extends Controller
{
    /**
     * Home About
     *
     * @return void
     */
    public function HomeAbout()
    {
        $homeabout = HomeAbout::latest()->paginate(3);
        return view('admin.home.index', compact('homeabout'));
    }


    /**
     * Add About
     *
     * @return void
     */
    public function AddAbout()
    {
        return view('admin.home.create');
    }

    /**
     * Store About
     *
     * @param Request $request
     * @return void
     */
    public function StoreAbout(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|min:4',
            'short_dis' => 'required|max:200',
            'long_dis' => 'required|max:500',
        ], [
            'title.min' => 'about longer then 4Chars',
            'short_dis.max' =>  'about longer under 200Chars',
            'long_dis.max' =>  'about longer under 200Chars',
        ]);

        HomeAbout::insert([
            'title' => $request->title,
            'short_dis' => $request->short_dis,
            'long_dis' => $request->long_dis,
            'created_at' => Carbon::now()
       ]);

       return Redirect()
           ->route('home.about')
           ->with('success', 'About Inserted Succesfully');
    }


    /**
     * Edit about
     *
     * @param [type] $id
     * @return void
     */
    public function EditAbout($id)
    {
        $about = HomeAbout::find($id);
        return view('admin.home.edit', compact('about'));
    }


    /**
     * Update About
     *
     * @param Request $request
     * @param [type] $id
     * @return void
     */
    public function UpdateAbout(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|min:4',
            'short_dis' => 'required|max:200',
            'long_dis' => 'required|max:500',
        ], [
            'title.min' => 'about longer then 4Chars',
            'short_dis.max' =>  'about longer under 200Chars',
            'long_dis.max' =>  'about longer under 200Chars',
        ]);

        HomeAbout::find($id)
            ->update([
                'title' => $request->title,
                'short_dis' => $request->short_dis,
                'long_dis' => $request->long_dis,
            ]);

        return Redirect()
           ->route('home.about')
           ->with('success', 'About Updated Succesfully');
    }


    public function DeleteAbout($id)
    {
        $delete = HomeAbout::find($id)->delete();
        return Redirect()
           ->back()
           ->with('success', 'About Deleted Succesfully');
    }

}
