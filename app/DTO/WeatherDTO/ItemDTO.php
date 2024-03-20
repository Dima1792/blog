<?php

namespace App\DTO\WeatherDTO;

use function PHPUnit\Framework\stringContains;

class ItemDTO
{
    public $weatherParamsHourly = [ "time" => [     "time"=> 0,
                                                    "temperature_2m" => 0,
                                                    "relative_humidity_2m" => 0,
                                                    "precipitation_probability"=>0,
                                                    "surface_pressure" =>0,
                                                    "wind_speed_10m" => 0
                                              ],
                                    "unit" => [     "time"=> '',
                                                    "temperature_2m" => '',
                                                    "relative_humidity_2m" => '',
                                                    "precipitation_probability"=>'',
                                                    "surface_pressure" =>'',
                                                    "wind_speed_10m" => ''
                                              ],
                                    "name" => [     "time"=> " на ",
                                                    "temperature_2m" => "Температура ",
                                                    "relative_humidity_2m" => "Влажность ",
                                                    "surface_pressure"=>'Давление ',
                                                    "precipitation_probability" =>"Вероятность осадков ",
                                                    "wind_speed_10m" => "Ветер в приземном слое "
                                                    ]
                                    ];
    public $weatherParamsCurrent = array ( "current" => array(  "temperature_2m"=> 0,
                                                                "wind_speed_10m" => 0,
                                                                "relative_humidity_2m" => 0,),
                                            "unit" => array ( "temperature_2m"=> 0,
                                                                "wind_speed_10m" => 0,
                                                                "relative_humidity_2m" => 0,
                                                            )
                                        );
    public function getHourlyParamsForAPI():string
    {
        $listParam='&hourly=';
        foreach (array_keys($this->weatherParamsHourly['unit']) as $key) {
           if ($key!=='time'){
            $listParam .=$key.",";
            }
        }
        return $listParam;
    }
    public function getCurrentParamsForAPI():string
    {
        $listParam = "&";
        $listParam .= "current=";
        echo $listParam;
        foreach (array_keys($this->weatherParamsCurrent['unit']) as $key) {
            if ($key!=='time') {
                $listParam .= $key . ",";
            }
        }
        $listParam = (substr($listParam, 0, -1)) . "&<br>";
        echo $listParam;
        return $listParam;
    }
//http_build_query(
//array|object $data,
//string $numeric_prefix = "",
//?string $arg_separator = null,
//int $encoding_type = PHP_QUERY_RFC1738
//): string
}
