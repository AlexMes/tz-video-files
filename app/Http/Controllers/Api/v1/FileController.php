<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Api\v1\Controller;
use App\Http\Repositories\FileRepository;
use App\Http\Resources\FileListResource;
use App\Http\Requests\FileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FileController extends Controller
{
    public function __construct()
    {
        //
    }

    /**
     * @param Request $request
     * @param FileRepository $repository
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request, FileRepository $repository){
        return response()->json(FileListResource::collection($repository->index()));
    }

    public function file(FileRequest $request, FileRepository $repository){
        return $repository->getFile($request->id, $request);
    }
}
