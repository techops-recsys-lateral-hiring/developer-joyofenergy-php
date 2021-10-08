<?php

namespace App\Services;

use App\Models\ElectricityReadings;
use App\Models\MeterReadingsInitialize;
use Illuminate\Support\Facades\DB;

class MeterReadingService
{
    private $meterReadingInitializer;
    private $meterReadings;
    private $meterAssociatedReadings;

    public function __construct(MeterReadingsInitialize $meterReadingInitializer)
    {
        $this->meterReadingInitializer = $meterReadingInitializer;
        $this->meterReadings = $this->meterReadingInitializer->electricityReadings;
    }

    public function getReadings($smartMeterId)
    {
        $readings = DB::table(ElectricityReadings::$tableName)
            ->join('smart_meters', 'electricity_readings.smart_meter_id', '=', 'smart_meters.id')
            ->where('smart_meters.smartMeterId', '=', $smartMeterId)
            ->get(['time', 'reading']);

        return $readings;
    }

    public function generateMeterAssociatedReadings()
    {
        foreach ($this->meterReadings as $meterReading) {
            $this->meterAssociatedReadings[$meterReading["smartMeterId"]] = $meterReading["electricityReadings"];
        }
    }

    public function storeReadings($smartMeterId, $readings)
    {
        $this->generateMeterAssociatedReadings();
        if (!array_key_exists($smartMeterId, $this->meterAssociatedReadings)) {
            $this->meterAssociatedReadings[$smartMeterId] = [];
        }
        foreach ($readings as $reading) {
            array_push($this->meterAssociatedReadings[$smartMeterId], $reading);
        }
    }
}
