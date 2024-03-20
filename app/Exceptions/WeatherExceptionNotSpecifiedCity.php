<?php

namespace App\Exceptions;

class WeatherExceptionNotSpecifiedCity extends \Exception
{
    public function recLog()
    {
        file_put_contents((dirname(__DIR__).'/Logs/errorsWithPageWeather.log'),
            $this->getlog(),
            FILE_APPEND);
    }
    protected function getLog():string
    {
        return sprintf(
            "Произошла ошибка в файле: %s" . PHP_EOL .
            "Код ошибки: %s" . PHP_EOL .
            "- %s" . PHP_EOL.
            "- %s".PHP_EOL . PHP_EOL ,
            $this->getFile(),
            300,
            $this->getMessage(),
            date('l jS \of F Y h:i:s A'));
    }
}

