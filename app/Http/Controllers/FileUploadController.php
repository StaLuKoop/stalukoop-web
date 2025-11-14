<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileUploadController extends Controller
{
  public function store(Request $request)
  {
    $validated = $request->validate([
      'file' => ['required', 'file', 'max:10240'],   // 10MB
      'folder' => ['required', 'string']             // dynamic folder name
    ]);

    $path = $request->file('file')->store($validated['folder'], 'public');

    return response()->json([
      'success' => true,
      'path' => $path,
      'url' => Storage::url($path)
    ]);
  }
}
