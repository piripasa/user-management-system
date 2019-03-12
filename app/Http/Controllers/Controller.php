<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function respondSuccess($data, $statusCode = 200)
    {
        $response = [];
        if (array_key_exists('message', $data)) {
            $response['message'] = $data['message'];
        }
        if (array_key_exists('data', $data)) {
            $response['data'] = $data['data'];
        }
        return $this->respond($response, $statusCode);
    }

    public function respondError($data, $statusCode = 400)
    {
        $response['error'] = true;
        if (array_key_exists('message', $data)) {
            $response['message'] = $data['message'];
        }
        if (array_key_exists('data', $data)) {
            $response['causes'] = $data['data'];
        }
        return $this->respond($response, $statusCode);
    }

    private function respond($data, $statusCode)
    {
        return response()->json($data, $statusCode);
    }
}
