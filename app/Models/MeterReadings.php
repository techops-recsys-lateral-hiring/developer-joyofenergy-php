<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class MeterReadings extends Model
{
    private $smartMeterId;
    private $electricityReadings = [];

    public function __construct($smartMeterId, $electricityReadings)
    {
        $this->smartMeterId = $smartMeterId;
        $this->electricityReadings = $electricityReadings;
    }

    /**
     * @return mixed
     */
    public function getSmartMeterId()
    {
        return $this->smartMeterId;
    }

    /**
     * @return mixed
     */
    public function getElectricityReadings()
    {
        return $this->electricityReadings;
    }
}
