<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('add_file');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();
            $fileSize = $file->getSize();
            $size = number_format(round( $fileSize / 1024, 1)) ;
            $f_size = str_replace(',', '.', $size);
            // dd(doubleval($f_size));
            // $fileType = $file->getClientMimeType();
            $fileType = $file->extension();
            // $path = str_replace('.'.$fileType, '', $fileName);
            $path = Storage::putFile('public/file', $file);
            // // $filePath = $file->store('uploads', 'public');
        // dd($fileName, $fileSize, $fileType, $path);
        File::create([
            'folder_id' =>'9c598cff-3679-4aad-8c93-e2e8d40aefac',
            'user_id' => '1',
            'file_name' => $fileName,
            'file_size' => doubleval($f_size),
            'file_type' => $fileType,
            'file_locate' => $path,
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
