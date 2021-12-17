<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileUploadRequest;
use Illuminate\Http\JsonResponse;

class FileController extends Controller
{
    /**
     * Uploads new logo image to server, returns image path
     *
     * @param FileUploadRequest $request
     * @return JsonResponse
     */
    public function upload(FileUploadRequest $request): JsonResponse
    {
        $path = $request->file('file')->store('logo');

        return response()->json(['file' => $path]);
    }
}
