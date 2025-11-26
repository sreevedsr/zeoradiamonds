<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function uploadTempImage(Request $request)
    {
        $request->validate([
            'file' => 'required|image|max:2048',
        ]);

        // store in /public/temp
        $path = $request->file('file')->store('temp', 'public');

        return [
            'path' => $path,
            'url'  => asset('storage/'.$path),
        ];
    }
}

