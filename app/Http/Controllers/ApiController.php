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

                $imageName = $this->sendForDecodeAndStorage($client, $request->imageBlob);
                !is_null($imageName) ? $numPeopleDetected = $this->sendForCounting($client, $imageName) : abort(400, 'Bad Request');
                !is_null($numPeopleDetected) ? $response = $this->sendForUpdate($client, $imageName, $numPeopleDetected) : abort(400, 'Bad Request');

                return $response;
            }
        } catch (Exception $e) {
            return response()->json(['success' => false, 'status' => get_class($e), 'message' => $e->getMessage()]);
        }

        return response()->json(['success' => false, 'status' => 400, 'message' => "Invalid parameters"]);
    }

    public function sendForDecodeAndStorage($client, $imageBlob)
    {
        $response = $client->post(env('LIVEIMAGE_HOST') . '/api/liveimage/store', [
            'form_params' => [
                'imageBlob' => $imageBlob,
            ],
        ]);

        if ($response->getStatusCode() === 200) {
            $decodedResponse = json_decode($response->getBody()->getContents(), true);
            $imageName = $decodedResponse['imageName'];
            return $imageName;
        }

        return null;
    }

    public function sendForCounting($client, $imageName)
    {
        $response = $client->get(env('PEOPLECOUNTER_HOST') . '/api/peoplecounter/' . $imageName . '.jpg');
        if ($response->getStatusCode() === 200) {
            $decodedResponse = json_decode($response->getBody()->getContents(), true);
            $numPeopleDetected = $decodedResponse['totalDetected'];
            return $numPeopleDetected;
        }

        return null;
    }

    public function sendForUpdate($client, $imageName, $numPeopleDetected)
    {
        $response = $client->post(env('LIVEIMAGE_HOST') . '/api/liveimage/' . $imageName, [
            'form_params' => [
                'numPeopleDetected' => $numPeopleDetected,
            ],
        ]);

        if ($response->getStatusCode() === 200) {
            $decodedResponse = json_decode($response->getBody()->getContents(), true);
            return $decodedResponse;
        }

        return null;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {

            $client = new Client();

            $response = $client->request('GET', env('LIVEIMAGE_HOST') . '/api/liveimage', [
                'query' => $request->query(),
            ]);

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

    public function average(Request $request)
    {
        try {

            $client = new Client();

            $response = $client->request('GET', env('LIVEIMAGE_HOST') . '/api/liveimage/average', [
                'query' => $request->query(),
            ]);

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

    public function paginate(Request $request)
    {
        try {

            $client = new Client();

            $response = $client->request('GET', env('LIVEIMAGE_HOST') . '/api/liveimage/paginate', [
                'query' => $request->query(),
            ]);

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
