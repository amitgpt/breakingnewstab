<?php

namespace BreakingNEWSTab\Http\Controllers\Admin;

use Illuminate\Http\Request;
use BreakingNEWSTab\Http\Controllers\Controller;
use BreakingNEWSTab\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use BreakingNEWSTab\User;

class ChangePasswordController extends Controller
{
    /**

     * Create a new controller instance.

     *

     * @return void

     */

    public function __construct()
    {

        $this->middleware('auth');

    }

    /**

     * Show the application dashboard.

     *

     * @return \Illuminate\Contracts\Support\Renderable

     */

    public function index()
    {

        return view('admin.password.changePassword');

    } 

        /**

     * Show the application dashboard.

     *

     * @return \Illuminate\Contracts\Support\Renderable

     */

    public function store(Request $request)
    {
        $input = $request->all();

        $request->validate([

            'current_password' => ['required', new MatchOldPassword],

            'new_password' => ['required'],

            'new_confirm_password' => ['same:new_password'],

        ]);
        
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);   
        
        return redirect('/admin/change-password')->with('success', 'Password change successfully.');
       

    }

}
