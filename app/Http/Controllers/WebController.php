<?php

namespace App\Http\Controllers;

use App\Http\Resources\FolderResource;
use App\Models\File;
use App\Models\Folder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use function Laravel\Prompts\select;

class WebController extends Controller
{
    public function getFolder(){
        $data = Folder::with('subfolders','files')
                        ->whereNull('deleted_at')
                        ->whereNull('folder_id')
                        ->get();
        return  FolderResource::collection($data);
    }
    public function selectFolder(string $id){
        $data = Folder::with('subfolders','files')
                        ->where('id', $id)  
                        ->whereNull('deleted_at')
                        ->whereNull('folder_id')
                        ->get();
        return  FolderResource::collection($data);
    }
    public function postFolder(Request $request)
    {
        $request->validate([
            'nama' => 'required | string | max:255',
            'parent' => 'nullable',
        ]);
        Folder::create([
            'user_id' => '1',
            'folder_nama' => $request->nama,
            'folder_id' => $request->parent
          
        ]);
        return ('success');
    }
    public function updateFolder(Request $request, string $id )
    {
        $folder = Folder::findOrFail($id);
        $request->validate([
            'nama' => 'required | string | max:255',
            'parent' => 'nullable',
        ]);
        $data=([
            'user_id' => '1',
            'folder_nama' => $request->nama,
            'folder_id' => $request->parent
          
        ]);
        $folder->update($data);
        return ('success');
    }
    public function deletefolder(string $id)
    {
        $data = Folder::findOrFail($id);
        $data->delete();
        return response()->json('data berhasil di hapus');
    }


    //file
    public function getFile(){
        $softDeletedFiles = File::withTrashed()->get();

        // Iterasi melalui setiap instance model dan panggil restore()
        foreach ($softDeletedFiles as $file) {
            $file->restore();
        }
        $data = DB::table('file')->select('*')->whereNull('deleted_at')->get();
        return response()->json($data);
    }
    public function createFile(Request $request)
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
            'folder_id' =>$request->folder,
            'user_id' => $request->user,
            'file_name' => $fileName,
            'file_size' => doubleval($f_size),
            'file_type' => $fileType,
            'file_locate' => $path,
        ]);
        return ('success');
    }
    public function deleteFile(string $id)
    {
        File::withTrashed()->all()->restore();
        
        $data = File::findOrFail($id);
        $data->delete();
        return response()->json('data berhasil di hapus');
    }

}
