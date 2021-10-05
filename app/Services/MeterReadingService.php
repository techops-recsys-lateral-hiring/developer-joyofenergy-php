<?php

namespace App\Services;

use App\Helpers\ModelHelper;
use App\Models\MeterReadingsInitialize;

class MeterReadingService
{
    private $meterReadingInitializer;

    public function __construct(MeterReadingsInitialize $meterReadingInitializer){
        $this->meterReadingInitializer = $meterReadingInitializer;
    }

    public function getReadings($smartMeterId){
        $getElectricityReadings = $this->meterReadingInitializer->electricityReadings;
        $smartMeterIdReadings = [];
        foreach ($getElectricityReadings as $getElectricityReading){
            if($getElectricityReading["smartMeterId"] == $smartMeterId){
                $smartMeterIdReadings = $getElectricityReading["electricityReadings"];
            }
        }
        return $smartMeterIdReadings;
    }

    public function storeReadings($smartMeterId, $readings)
    {
        //    app(ModelHelper::class)->setFoo("DID THE POSTING JUST NOW...");
        //print_r(app(ModelHelper::class)->getFoo());

//        if (array_key_exists($smartMeterId, $this->meterAssociatedReadings)) {
//            print_r($this->meterAssociatedReadings[$smartMeterId]);
//            foreach ($readings as $reading) {
//                array_push($this->meterAssociatedReadings[$smartMeterId], $reading);
//            }
//            print_r($this->meterAssociatedReadings[$smartMeterId]);
//            return ("SUCCESS");
//        } else {
//            return ("FAILED");
//        }
    }
}
