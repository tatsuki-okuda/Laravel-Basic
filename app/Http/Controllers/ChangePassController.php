<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePassController extends Controller
{
    

    /**
     * Return Change Pasword Page
     *
     * @return void
     */
    public function CPassword()
    {
        return view('admin.body.change_password');
    }


    /**
     * User Password Change
     *
     * @param Request $request
     * @return void
     */
    public function UpdatePassword(Request $request)
    {
        $validateData = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
        ]);

        $hashedPassword = Auth::user()->password;
        // ログインユーザーと入力された古いパスワードをチェックする。
        if(Hash::check($request->oldpassword, $hashedPassword)){
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()
                ->route('login')
                ->with('succes', 'Pasword Is Change Succesfuly');
        } else {
            return redirect()
                ->back()
                ->with('error', 'Current Pasword Is Invalid');
        }
    }
}
