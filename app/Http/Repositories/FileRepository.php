<?php

namespace App\Http\Repositories;

use App\Models\Column;
use App\Models\File;
use App\Models\Project;
use App\Models\Table;
use http\Env\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FileRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function index(){
        return File::select(['files.id', 'files.name'])
            ->leftJoin('user_files', 'user_files.file_id', '=', 'files.id')
            ->Where(['user_files.user_id' => Auth::id() ])
            ->orderBy('files.created_at', 'desc')
            ->get();
    }

    public function getFile($id, $request){
        $file = File::select(['files.id', 'files.name', 'files.path'])
            ->leftJoin('user_files', 'user_files.file_id', '=', 'files.id')
            ->Where(['user_files.user_id' => Auth::id() ])
            ->Where(['files.id' => $id ])
            ->orderBy('files.created_at', 'desc')
            ->first();

        if (Storage::exists($file['path'])) {
            $mimeType = Storage::mimeType($file['path']);
            $contentDisposition = $request->input('download') ? 'attachment' : 'inline';

            return Storage::response($file['path'], 200, [
                'Content-Type' => $mimeType,
                'Content-Disposition' => $contentDisposition . '; filename="' . basename($file['name']) . '"',
                'Accept-Ranges' => 'bytes',
            ]);

        }else{
            return response()->json(['error' => 'File not exists.']);
        }

    }



}


