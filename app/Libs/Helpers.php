<?php

/**Response Structure */
if (!function_exists('responseOk')) {

    function responseOk($data, $status = 200, $message = null)
    {
        if (!$message) {
            $message = "Done";
        }

        return response()->json(['is_successful' => true, 'data' => $data, 'message' => $message], $status);
    }
}

if (!function_exists('responseError')) {

    function responseError($message, $status = 400)
    {
        return response()->json(['is_successful' => false, 'message' => $message, 'data' => []], $status);
    }
}

/**Service Return Structure */
if (!function_exists('serviceOk')) {

    function serviceOk($data, $status = 200)
    {

        return ['is_successful' => true, 'data' => $data, 'status' => $status];
    }
}

if (!function_exists('serviceError')) {

    function serviceError($message, $status = 400)
    {
        return ['is_successful' => false, 'message' => $message, 'status' => $status];
    }
}

if (!function_exists('generateRandomString')) {

    function generateRandomString($length = 21)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
