<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Services\DeviceService;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    protected $deviceService;

    public function __construct(ApiResponse $apiResponse, DeviceService $deviceService)
    {
        parent::__construct($apiResponse);
        $this->deviceService = $deviceService;
    }

    public function getLastTxt(string $deviceId)
    {
        $fileText = Storage::disk('public')->get("last/$deviceId.txt");
        $fileName = "last_$deviceId.txt";
        $headers = ['Content-type' => 'text/plain','Content-Disposition' => sprintf('attachment; filename="%s"', $fileName),];

        return Response::make($fileText, 200, $headers);
    }
}
