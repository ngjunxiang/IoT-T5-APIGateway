<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ApiController extends Controller
{

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
                $client = new Client();

                $response = $client->post(env('LIVEIMAGE_HOST') . '/api/liveimage/store', [
                    'form_params' => [
                        'imageBlob' => $request->imageBlob,
                    ],
                ]);

                if ($response->getStatusCode() === 200) {
                    $decodedResponse = json_decode($response->getBody()->getContents(), true);
                    return $decodedResponse;
                }
            }
        } catch (Exception $e) {
            return response()->json(['success' => false, 'status' => get_class($e), 'message' => $e->getMessage()]);
        }

        return response()->json(['success' => false, 'status' => 400, 'message' => "Invalid parameters"]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function liveImageList()
    {
        try {
            $client = new Client();

            $response = $client->get(env('LIVEIMAGE_HOST') . '/api/liveimage');
            if ($response->getStatusCode() === 200) {
                $decodedResponse = json_decode($response->getBody()->getContents(), true);
                return $decodedResponse;
            }
            return $response;
        } catch (Exception $e) {
            return response()->json(['success' => false, 'status' => get_class($e), 'message' => $e->getMessage()]);
        }

        return response()->json(['success' => false, 'status' => 400, 'message' => "Invalid parameters"]);
    }

}
