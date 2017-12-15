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
}
