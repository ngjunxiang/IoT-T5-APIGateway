<?php

namespace App\Http\Controllers;

use App\LiveImage;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function liveImageList()
    {
        try {
            $liveImages = LiveImage::all();

            return response()->json(['success' => true, 'images' => $liveImages]);

        } catch (Exception $e) {
            return response()->json(['success' => false, 'status' => get_class($e), 'message' => $e->getMessage()]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function liveImageStore(Request $request)
    {
        try {
            if ($request->imageBlob) {
                $liveImage = LiveImage::create(['imageBlob' => $request->imageBlob]);
            }
            return response()->json(['success' => true, 'image' => $liveImage]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'status' => get_class($e), 'message' => $e->getMessage()]);
        }
    }
}
