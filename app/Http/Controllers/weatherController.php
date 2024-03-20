<?php

namespace App\Http\Controllers;

use App\Exceptions\WeatherExceptionNotSpecifiedCity;
use App\Exceptions\WetherExceptionsNotFoutCity;
use App\Services\WeatherService;
use PhpParser\Node\Stmt\Finally_;


class weatherController extends Controller
{
    public function getWeather(WeatherService $weatherService , $city, int $time=0)
    {
        view('weather',['cityGet'=>$city]);
        if (isset($_GET['cityGet'])){
            $city = $_GET['cityGet'];
            $time = $_GET['timeGet'];
        }
        try {
            $result= $weatherService->getStringFromResult($weatherService->getWeatherFormAPI($city), $time, $city);
            //return view('weather',compact('result'));
        } catch (WeatherExceptionNotSpecifiedCity  $exception) {
            $exception->recLog();
            $city = "Петропавловск-Камчатский";
            echo 'Значение города не введено, город по умолчанию Петропавловск-Камчатский';
            $result= $weatherService->getStringFromResult($weatherService->getWeatherFormAPI($city), $time, $city);
        }catch (WetherExceptionsNotFoutCity $exception){
            $city = "Москва";
            $exception->recLog();
            echo 'Значение города заданно не верно, выбран город по умолчанию Москва';
            $result= $weatherService->getStringFromResult($weatherService->getWeatherFormAPI($city), $time, $city);
        }catch (\Exception) {
            echo 'Не знаю что ты такое на тварил разбирайся сам';
        }

        return view('weather', compact('result'));
    }
}
