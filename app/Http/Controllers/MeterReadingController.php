<?php

namespace App\Http\Controllers;

use App\Models\MeterReadings;
use App\Services\MeterReadingService;
use Illuminate\Http\Request;
use App\Models\ElectricityReading;

class MeterReadingController extends Controller
{

    private $meterReadingService;

    public function __construct()
    {
        $this->meterReadingService = new MeterReadingService();
    }

    public function getReading($smartMeterId) {
        return response()->json( $this->meterReadingService->getReadings($smartMeterId), 200);
    }

    public function storeReadings(Request $request)
    {
        $res = $this->meterReadingService->storeReadings($request->all()["smartMeterId"], $request->all()["electricityReadings"]);
        print_r(json_decode($res));
        if ($res === "SUCCESS") {
            return response()->json("SUCCESS", 201);
        } else {
            return response()->json("ERROR OCCURRED", 500);
        }
    }
}
