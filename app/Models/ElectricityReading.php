<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ElectricityReading extends Model
{
    private $time;
    private $reading;

    public function __construct($time, $reading)
    {
        $this->time = $time;
        $this->reading = $reading;
    }

    /**
     * @return mixed
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @return mixed
     */
    public function getReading()
    {
        return $this->reading;
    }
}
