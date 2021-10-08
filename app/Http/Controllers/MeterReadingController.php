<?php

namespace App\Http\Controllers;

use App\Services\MeterReadingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Context;

class MeterReadingController extends Controller
{

    private $meterReadingService;

    public function __construct(MeterReadingService $meterReadingService)
    {
        $this->meterReadingService = $meterReadingService;
    }

    public function getReading($smartMeterId)
    {
        $readings = DB::table('electricity_readings')
            ->join('smart_meters', 'electricity_readings.smart_meter_id', '=', 'smart_meters.id')
            ->where('smart_meters.smartMeterId', '=', $smartMeterId)
            ->get(['time', 'reading']);
        return response()->json($readings);
        // return response()->json($this->meterReadingService->getReadings($smartMeterId), 200);
    }

    public function storeReadings(Request $request)
    {
        $this->meterReadingService->storeReadings($request->all()["smartMeterId"], $request->all()["electricityReadings"]);
        return response()->json("SUCCESS", 201);
    }
}
