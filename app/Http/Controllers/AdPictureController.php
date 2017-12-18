<?php

namespace OtcCms\Http\Controllers;

use Illuminate\Http\Request;
use OtcCms\Models\AdPicture;

class AdPictureController extends Controller
{
    public function index(Request $requet)
    {
        return view('adpicture.index', [
            'pictures' => AdPicture::findAll(),
        ]);
    }

    public function add(Request $request)
    {
        return view('adpicture.add');
    }

    public function save(Request $request)
    {
        $filename = $request->input('url');
        if (empty($filename)) {
            return response()->json([
                'error' => 'url is empty',
            ], 400);
        }
        $adPicture = AdPicture::create($filename);
        $adPicture->save();
        return response()->json();
    }

    public function reorder(Request $request)
    {
        $files = $request->input('pictures');
        AdPicture::reset($files);
        return redirect()->back();
    }
}
