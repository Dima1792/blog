<?php

namespace App\Services;


use App\DTO\WeatherDTO\ItemDTO;
use App\Exceptions\WeatherExceptionNotSpecifiedCity;
use App\Exceptions\WetherExceptionsNotFoutCity;
class WeatherService extends Service
{
    const FILECITUCONFIG = '/File/ListCity.txt';
    protected function getItemDTO(): ItemDTO
    {
        return new ItemDTO();
    }

    public function getWeatherFormAPI($city)
    {
        $cities = json_decode(file_get_contents(
            dirname(__DIR__, 1) . static::FILECITUCONFIG),
            true);
        $item = $this->getItemDTO();
        if (empty($city)) {
            throw new WeatherExceptionNotSpecifiedCity('Криворукий пользователь не ввел название города');
        }
        if (!array_key_exists($city, $cities)) {
            throw new WetherExceptionsNotFoutCity('Криворукий пользователь не правильно ввел название города');
        }
        $UrlRequestAPI =  sprintf(/*Basa URL*/ "%s". /*Координаты города*/"%s". /*Params Hourly*/ "%s",
                    env('APY_Weater_BASA_URL'),
                    $cities[$city],
                    //$item->getCurrentParamsForAPI(),
                    $item->getHourlyParamsForAPI());
        $data = json_decode($this->getData($city . 'weather.log' , $UrlRequestAPI ) , true);
        $item->weatherParamsHourly['unit'] = $data['hourly_units'];
        $item->weatherParamsHourly['time'] = $data['hourly'];

        return $item;
    }

    public function getStringFromResult($items, $time, $city) : array
    {
        $count = 0;
        $resultText[$count] = 'Погода для города ' . $city;
        foreach ($items->weatherParamsHourly['time'] as $param => $value) {
            $count++;
            $resultText[$count] = $items->weatherParamsHourly['name'][$param];
            $resultText[$count] .= " = {$items->weatherParamsHourly['time'][$param][$time]} ";
            $resultText[$count] .= $items->weatherParamsHourly['unit'][$param];
        }

        return $resultText;
    }
}

