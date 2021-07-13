<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function uploadForm()
    {
        return view('upload_form');
    }

    public function uploadSubmit(Request $request)
    {
        // Coming soon...
    }

    public function uploadToGallery(Request $request)
    {
        /** @var User $user */
        $user = auth()->user();

        $user->settings->update([
            'picture'=> $request->file('picture')->store('userGallery'),
        ]);

        return redirect()
            ->route('profile.edit')
            ->with('status', __('Gallery has been updated'));
    }
}
