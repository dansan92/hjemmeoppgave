<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use File;
use Html;
use Auth;
use DB;
use Session;

class PagesController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Pages Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles static pages
    |
    */

    // About page, for everyone
    public function about()
    {
    	$name = 'Daniel Sandnes';
    	return view('pages.about')->with('name', $name);
    }

    // Images page, for everyone
    public function images()
    {
       return view('pages.images');
    }

    // Upload page, for users
    public function upload()
    {
        return view('pages.upload');
    }

    // Control panel page, for admins
    public function controlpanel() 
    {
        // Check if logged in and admin, for security reasons (to prevent direct access through URL)
        if (Auth::check()) {
            $user = Auth::user();
            $user = DB::table('users')->where('email', $user->email)->first();
            if ($user->role == 'admin') {
                return view('pages.controlpanel');
            } else {
                Session::flash('error', 'You are not an admin!');
                return view('welcome');
            }
        }
    }
}