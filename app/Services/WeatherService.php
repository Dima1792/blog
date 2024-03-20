<?php

namespace App\Services;


use App\DTO\WeatherDTO\ItemDTO;
use App\Exceptions\WeatherExceptionNotSpecifiedCity;
use App\Exceptions\WetherExceptionsNotFoutCity;

class WeatherService extends Service
{
    protected function getItemDTO(): ItemDTO
    {
        return new ItemDTO();
    }

    public function getWeatherFormAPI($city)
    {
        $cities = [];
        foreach (json_decode(file_get_contents(dirname(__DIR__, 1) . '/File/ListCity.txt')) as $key => $value) {
            $cities[$key] = $value;
        }
        //echo $cities[$city];
        $item = $this->getItemDTO();
        if (empty($city)) {
            throw new WeatherExceptionNotSpecifiedCity('Криворукий пользователь не ввел название города');
        }
        if (!array_key_exists($city, $cities)) {
            throw new WetherExceptionsNotFoutCity('Криворукий пользователь не правильно ввел название города');
        }
        $data = json_decode($this->getData(($city . 'weather.log'), sprintf("%s" . "%s" . "%s",
            env('APY_Weater_BASA_URL'),
            $cities[$city],
            //$item->getCurrentParamsForAPI(), //запрос на фактическую погоду
            $item->getHourlyParamsForAPI())),  //дергаем нужные параметры для прогнозов
            true);
        foreach ($item->weatherParamsHourly['unit'] as $params => $value) {
            $item->weatherParamsHourly['unit'][$params] = $data['hourly_units'][$params];
            if (!empty ($data['hourly'][$params])) {
                $item->weatherParamsHourly['time'][$params] = $data['hourly'][$params];
            }
        }

        return $item;
    }

    public function getStringFromResult($items, $time, $city)
    {
        $count = 0;
        $resultText[$count] = 'Погода для города ' . $city; /* название города */
        foreach ($items->weatherParamsHourly['time'] as $param => $value) {
            $count++;
            $resultText[$count] = $items->weatherParamsHourly['name'][$param] . " = ";/* название параметра */
            $resultText[$count] .= "{$items->weatherParamsHourly['time'][$param][$time]} ";    /* значене переметра */
            $resultText[$count] .= $items->weatherParamsHourly['unit'][$param]; /* единицы измерения */
        }

        return $resultText;
    }
}

