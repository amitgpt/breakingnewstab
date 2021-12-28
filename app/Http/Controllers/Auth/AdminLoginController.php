<?php

namespace BreakingNEWSTab\Http\Controllers\Auth;

use Illuminate\Http\Request;
use BreakingNEWSTab\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
        /*

    |--------------------------------------------------------------------------

    | Login Controller

    |--------------------------------------------------------------------------

    |

    | This controller handles authenticating users for the application and

    | redirecting them to your home screen. The controller uses a trait

    | to conveniently provide its functionality to your applications.

    |

    */

 

    use AuthenticatesUsers;

    /**

     * Where to redirect users after login.

     *

     * @var string

     */

    protected $redirectTo = '/admin/dashboard';

 

    /**

     * Create a new controller instance.

     *

     * @return void

     */

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

 

    public function showLoginForm()
    {        
        return view('auth.adminLogin');
    }

 

    public function login(Request $request)
    {
        $input = $request->all();

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->attempt(['email' => $request->email, 'password' => $request->password])) {

            return redirect('/admin/dashboard');

        }

        return back()->withErrors(['email' => 'Email or password are wrong.']);

    }


    public function showPasswordResetForm(){
        return view('auth.passwords.reset');
    }


    public function logout(Request $request) {
        Auth::logout();
        return redirect('/admin/login');
    }
}
