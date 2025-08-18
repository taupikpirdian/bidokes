<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

function generateRandomString($length = 10): string
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function extraxtFile($file)
{
    $rand = generateRandomString();
    $ext = $file->getClientOriginalExtension();
    $name = $rand . "-" . date('YmdHis') . '.' . $ext;
    // Get the original name of the file
    $originalName = $file->getClientOriginalName();
    // Get the file extension (type)
    $fileExtension = $file->getClientOriginalExtension();

    return [
        'original_name' => $originalName,
        'name' => $name,
        'type_file' => $fileExtension,
    ];
}

function storeFile($request, $uuid, $nameForm, $type)
{
    $path = "";
    $generateName = "";

    if ($request->hasFile($nameForm)) {
        $generateName = extraxtFile($request->$nameForm)['name'];
        $path = $request->file($nameForm)->storeAs($uuid, $generateName, options: $type);
    }

    return [
        'path' => $path,
        'name_file' => $generateName,
    ];
}

function storeFileCustom($uuid, $file, $type)
{
    if ($file == null) {
        return [
            'path' => "",
            'file_name' => "",
        ];
    }

    $path = "";
    $generateName = "";

    $generateName = extraxtFile($file)['name'];
    $path = $file->storeAs($uuid, $generateName, options: $type);

    return [
        'path' => $path,
        'file_name' => $generateName,
    ];
}

function number_format_short($n, $precision = 1)
{
    if ($n < 900) {
        $n_format = number_format($n, $precision);
        $suffix = '';
    } else if ($n < 900000) {
        $n_format = number_format($n / 1000, $precision);
        $suffix = 'K';
    } else if ($n < 900000000) {
        $n_format = number_format($n / 1000000, $precision);
        $suffix = 'JT';
    } else if ($n < 900000000000) {
        $n_format = number_format($n / 1000000000, $precision);
        $suffix = 'M';
    } else {
        $n_format = number_format($n / 1000000000000, $precision);
        $suffix = 'T';
    }
    if ($precision > 0) {
        $dotzero = '.' . str_repeat('0', $precision);
        $n_format = str_replace($dotzero, '', $n_format);
    }
    return $n_format . $suffix;
}

function changeFormatDate($date)
{
    if (!$date) return null;
    $carbonDate = Carbon::createFromFormat('d/m/Y', $date);
    return $carbonDate->format('Y-m-d');
}

function changeFormatDateV2($date)
{
    if (!$date) return null;
    $carbonDate = Carbon::createFromFormat('d-m-Y', $date);
    return $carbonDate->format('Y-m-d');
}

function backChangeFormatDate($date)
{
    if (!$date) return null;
    $carbonDate = Carbon::createFromFormat('Y-m-d', $date);
    return $carbonDate->format('d/m/Y');
}

function dateTimeToFormatDate($date)
{
    // Parse the original date using Carbon
    $carbonDate = Carbon::parse($date);
    // Format the date as "F, d Y" (month, day, year)
    $formattedDate = $carbonDate->format('l, d F Y');
    return $formattedDate;
}

function dateTimeToFormatDateOnly($date)
{
    // Parse the original date using Carbon
    $carbonDate = Carbon::parse($date);
    // Format the date as "F, d Y" (month, day, year)
    $formattedDate = $carbonDate->format('d/m/Y');
    return $formattedDate;
}

function dateTimeToFormatDateTime2($date)
{
    // Parse the original date using Carbon
    $carbonDate = Carbon::parse($date);
    // Format the date as "F, d Y" (month, day, year)
    $formattedDate = $carbonDate->format('l, d F Y H:i');
    return $formattedDate;
}

function dateTimeToFormatDateTime($date)
{
    // Parse the original date using Carbon
    $carbonDate = Carbon::parse($date);
    // Format the date as "F, d Y" (month, day, year)
    $formattedDate = $carbonDate->format('d/m/Y, H:i');
    return $formattedDate;
}

if (!function_exists('standardResponse')) {
    function standardResponse($status, $message, $data = null, $info = null)
    {
        if ($status == true) {
            $message = OK;
        }
        return [
            'status' => $status,
            'message' => $message,
            'info' => $info,
            'data' => $data,
        ];
    }
}

if (!function_exists('errorLog')) {
    function errorLog(array $data): void
    {
        if (isset($data['info'])) {
            Log::info($data['info']);
        }
        Log::error($data['message']);
    }
}

if (!function_exists('backtraceLog')) {
    function backtraceLog($e): void
    {
        Log::error('Terjadi error: ' . $e->getMessage(), [
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            // 'trace' => $th->getTraceAsString()
        ]);
    }
}
