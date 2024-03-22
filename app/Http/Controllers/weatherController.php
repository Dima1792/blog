<?php

namespace App\Http\Controllers;

use App\Exceptions\WeatherExceptionNotSpecifiedCity;
use App\Exceptions\WetherExceptionsNotFoutCity;
use App\Services\WeatherService;
use Illuminate\Http\Request;


class weatherController extends Controller
{
    public function getWeather(Request $request, WeatherService $weatherService, string $city = '', int $time = 0)
    {
        $city = $request->get('cityGet','');
        $time = $request->get('timeGet',0);
        try {
            $result = $weatherService->getStringFromResult(
                $weatherService->getWeatherFormAPI($city),
                $time, $city);
            return view('weather',compact('result'));

        } catch (WeatherExceptionNotSpecifiedCity  $exception) {
            $exception->recLog();
            $city = "Петропавловск-Камчатский";
            echo 'Значение города не введено, город по умолчанию Петропавловск-Камчатский';
            $result= $weatherService->getStringFromResult(
                $weatherService->getWeatherFormAPI($city),
                $time, $city);
            return view('weather',compact('result'));

        }catch (WetherExceptionsNotFoutCity $exception){
            $city = "Москва";
            $exception->recLog();
            echo 'Значение города заданно не верно, выбран город по умолчанию Москва';
            $result = $weatherService->getStringFromResult(
                $weatherService->getWeatherFormAPI($city),
                $time, $city);
            return view('weather', compact('result'));

        }catch (\Exception) {
            echo 'Не знаю что ты такое на тварил разбирайся сам';
        }
    }
}
