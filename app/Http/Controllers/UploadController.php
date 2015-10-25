<?php

namespace App\Http\Controllers;

use Input;
use Validator;
use Redirect;
use Request;
use Session;
use File;
use Auth;
use DB;

class UploadController extends Controller
{
	/*
    |--------------------------------------------------------------------------
    | Upload, Accept and Delete Images Contoller
    |--------------------------------------------------------------------------
    |
    | This controller handles uploading of files from PC and Instagram, aswell
    | as approving/deleting images through the control panel
    |
    */

	public function computerUpload()
	{
		/* UPLOAD IMAGES FROM COMPUTER
		*******************************/
		
		// Check if file is an image, with max size 3MB
		$file = array('file' => Input::file('file'));
		$rules = array('file' => 'required|image|max:3072');
		$validator = Validator::make($file, $rules);

		if ($validator->fails()) {
			Session::flash('error', 'Filen er ikke gyldig: kun jpeg, png, bmp, gif, eller svg. Maks 3MB');
			return Redirect::to('upload');
		}
		
		// Check if file is valid
		if (Input::file('file')->isValid()) {
			// Rename file to something random and save it to folder 'unverified-images' for admin approval
			$destinationPath = 'unverified-images';
			$extension = Input::file('file')->getClientOriginalExtension();
			$fileName = rand(1000000,9999999).'.'.$extension;
			Input::file('file')->move($destinationPath, $fileName);
			
			// Send user back to /upload with message
			Session::flash('success', 'Opplastet bilde fra PC vellykket'); 
			return Redirect::to('upload');
		}
		
		Session::flash('error', 'Filen er ikke gyldig');
		return Redirect::to('upload');
	}

	public function instagramUpload()
    {
		/* UPLOAD IMAGES FROM USERS INSTAGRAM
		***************************************/
		
		// Check if logged in and admin, for security reasons
		if (Auth::check()) {
			$user = Auth::user();
			$user = DB::table('users')->where('email', $user->email)->first();

			if ($user->role != 'admin')
				return 'Du må være administrator';
		} else
			return 'Du må være innlogget';

		// Rename file to something random and save it to folder 'unverified-images' for admin approval
		$fileName = htmlentities($_GET['fileName']);
		$fileExtension = explode('.', $fileName);
		$fileExtension = end($fileExtension);
		$content = file_get_contents($fileName);
		file_put_contents('unverified-images/'.rand(1000000,9999999).$fileExtension, $content);
		
		// Send user back to /upload with message
		Session::flash('success', 'Opplastet bilde fra Instagram vellykket'); 
		return Redirect::to('upload');
	}

	public function approveUpload()
    {
		/* APPROVE IMAGES FOR FRONT PAGE
		********************************/

		// Check if logged in and admin, for security reasons (to prevent direct access to URL)
		if (Auth::check()) {
			$user = Auth::user();
			$user = DB::table('users')->where('email', $user->email)->first();

			if ($user->role != 'admin')
				return 'Du må være administrator';
		} else
			return 'Du må være innlogget';

		// Check if file is an image, for security reasons (to prevent direct access to URL)
		$fileName = htmlentities($_GET['fileName']);
		$allowedMimeTypes = ['image/jpeg','image/gif','image/png','image/bmp','image/svg+xml'];
		$contentType = mime_content_type('unverified-images/'.$fileName);

		if(!in_array($contentType, $allowedMimeTypes) ) {
			Session::flash('error', 'Filen er ikke gyldig'); 
			return Redirect::to('controlpanel');
		}

		// Move the given image to folder 'verified-images'
		if (File::move('unverified-images/'.$fileName, 'verified-images/'.$fileName)) {
			Session::flash('success', 'Bilde godkjent'); 
			return Redirect::to('controlpanel');
		} else {
			Session::flash('error', 'Kunne ikke flytte bildet');
			return Redirect::to('controlpanel');
		}
	}

	public function declineUpload() {
		/* DECLINE AND DELETE UPLOADED IMAGES
		*************************************/
		
		// Slett det gitte bildet fra serveren
		$fileName = htmlentities($_GET['fileName']);
		if (File::delete('unverified-images/'.$fileName)) {
			Session::flash('success', 'Bilde slettet'); 
			return Redirect::to('controlpanel');
		} else {
			Session::flash('error', 'Kunne ikke slette bildet');
			return Redirect::to('controlpanel');
		}
	}
}