<?php

namespace App\Helpers;

use Carbon\Carbon;

trait ResponseFormatter
{
    /**
     * API Response
     *
     * @var array
     */
    protected static $response = [
        'meta' => [
            'code' => 200,
            'status' => 'success',
            'messages' => null,
            'validations' => null,
        ],
        'data' => null,
    ];

    /**
     * Give success response.
     */
    public static function success($data = null, $messages = null, $token = null)
    {
        if (!is_null($messages)) {
            self::$response['meta']['messages'] = $messages;
        }

        self::$response['meta']['response_date'] = Carbon::now()->format('Y-m-d H:i:s');
        self::$response['data'] = $data;
        if (!is_null($token)) {
            self::$response['token'] = $token;
        }

        return response()->json(self::$response, self::$response['meta']['code']);
    }

    /**
     * Give error response.
     */
    public static function error($code = 400, $messages = null, bool $isValidation = false, $data = null)
    {
        if (!is_null($messages)) {
            $key = $isValidation ? 'validations' : 'messages';
            self::$response['meta'][$key] = $messages;
        }

        self::$response['meta']['status'] = 'error';
        self::$response['meta']['code'] = $code;
        self::$response['meta']['response_date'] = Carbon::now()->format('Y-m-d H:i:s');
        self::$response['data'] = $data;

        return response()->json(self::$response, self::$response['meta']['code']);
    }

    /**
     * Give error response.
     */
    public static function unauthorized($code = 401, $messages = null, bool $isValidation = false)
    {
        if (!is_null($messages)) {
            $key = $isValidation ? 'validations' : 'messages';
            self::$response['meta'][$key] = $messages;
        }

        self::$response['meta']['status'] = 'error';
        self::$response['meta']['code'] = $code;
        self::$response['meta']['response_date'] = Carbon::now()->format('Y-m-d H:i:s');

        return response()->json(self::$response, self::$response['meta']['code']);
    }

    /**
     * 
     * error code
     */
    public static function errorCode($messages = null)
    {
        if (!is_null($messages)) {
            self::$response['meta']['messages'] = $messages;
        }

        self::$response['meta']['status'] = 'error';
        self::$response['meta']['code'] = 500;
        self::$response['meta']['response_date'] = Carbon::now()->format('Y-m-d H:i:s');

        return response()->json(self::$response, self::$response['meta']['code']);
    }
}
