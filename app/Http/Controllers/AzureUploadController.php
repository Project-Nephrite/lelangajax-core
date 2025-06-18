<?php

namespace App\Http\Controllers;

use App\Services\StorageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AzureUploadController extends Controller
{
    /**
     * Show the upload form.
     */
    public function form()
    {
        return view('tests.uploadFile');
    }

    /**
     * Handle file upload to Azure.
     */
    public function upload(Request $request, StorageService $upload)
    {
        $request->validate([
            'files' => 'required|array', // max 10MB
            'files.*' => 'file|max:10240', // 10MB per file
        ]);

        $uploadedPaths = [];
        foreach ($request->file('files') as $file) {
            $uploadedPaths[] = $upload->upload("uploads/tests", $file);
        }

        return back()->with('success', "Uploaded to Azure: $uploadedPaths");
    }
}
