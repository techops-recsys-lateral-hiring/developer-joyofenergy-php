<?php

namespace App\Services;

use App\Helpers\ModelHelper;
use App\Models\MeterReadingsInitialize;

class MeterReadingService
{
	private $meterReadingInitializer;
	private $meterReadings;
	private $meterAssociatedReadings;

    public function __construct(MeterReadingsInitialize $meterReadingInitializer){
	    $this->meterReadingInitializer = $meterReadingInitializer;
	    $this->meterReadings = $this->meterReadingInitializer->electricityReadings;
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

    public function generateMeterAssociatedReadings(){
	
	foreach ($this->meterReadings as $meterReading){
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
