<?php

namespace OtcCms\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function image(Request $request)
    {
        $image = exif_read_data($request->file);
        $ext = $this->getImageExt($image);
        if (null === $ext) {
            return response()->json([
                'error' => 'Only support jpeg/png',
            ], 400);
        }
        $filename = uniqid(time()).".{$ext}";
        $request->file->storeAs('public/images', $filename);
        return response()->json([
            'filename' => asset('storage/images/'.$filename),
        ]);
    }

    private function getImageExt($image)
    {
        switch($image['MimeType']) {
            case 'image/jpeg':
                return 'jpg';
            case 'image/png':
                return 'png';
            default:
                return null;
        }
    }
}
