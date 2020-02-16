<?php

namespace App\Http\Controllers;

use App\Login;
use Illuminate\Http\Request;
use Auth;
use Session;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        //session(['url.intended' => url()->previous()]);
        //$this->redirectTo = session()->get('url.intended');
        
    }

    public function index()
    {
        //
        return view('login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function postLogin(Request $request)
    {
        // Validate the form data
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        // Attempt to log the user in
        // Passwordnya pake bcrypt
        if (Auth::guard('admin')->attempt(['username' => $request->username, 'password' => $request->password])) {
            // if successful, then redirect to their intended location
            return redirect()->intended('/');
        } else {
            return redirect()->intended('/login');
        }
    }

    public function home()
    {

        if (Auth::check()) {
            return view('/');
        }
        return redirect('login')->withSuccess('Opps! You do not have access');
    }

    public function logout()
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        } 
        
        return redirect('/login');
    }

}
