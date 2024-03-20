<?php

namespace App\Http\Controllers;

use App\Exceptions\ExceptionNotRegCurrency;
use App\Services\CurrencyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;

class testController extends Controller
{
    public function testAction( Request $request, CurrencyService $currencyService,string $currency=null)
    {
        $currency ??= $request->post('currency', '');
        try {
            $result=$currencyService->getStringFromResult($currencyService->getCurrencies($currency));

            return view('currency', compact('result'));

        } catch (ExceptionNotRegCurrency $exception){
            Log::error($exception->getMessage() . PHP_EOL . $exception->getTraceAsString());
            abort(404);
            //include ((dirname(__DIR__,2).'/File/Error404.html'));
        } catch (\Throwable $exception){
            Log::error($exception->getMessage() . PHP_EOL . $exception->getTraceAsString());
            throw $exception;
        }
    }
}
