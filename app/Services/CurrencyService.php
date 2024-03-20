<?php

namespace App\Services;

use App\DTO\CurrencyCBR\ItemDTO;
use App\Exceptions\ExceptionNotRegCurrency;

class CurrencyService extends Service
{
    const VALUTS = ['USD', 'EUR', 'GBP','BYN',];
    protected function getItemDTO():ItemDTO
    {
        return new ItemDTO();
    }
    public function getCurrencies(string $currencies)
    {
        $data = json_decode(($this->getData('currency.log',env('APY_Currency_CBR_BASA_URL'))),true);
        $result = [];
        $item = $this->getItemDTO();
        if ((!empty($currencies)) && (!array_key_exists( $currencies , $data['Valute']))){
            throw new ExceptionNotRegCurrency('Криворукий пользователь не правильно ввел название валюты');
        } elseif (!empty($currencies) ) {
            $item->name = $currencies;
            $item->value = $data['Valute'][$currencies]['Value'];
            $result[] = $item;
        }   else{
            foreach (static::VALUTS as $currency) {
                if (!empty ($data['Valute'][$currency])) {
                    $item = $this->getItemDTO();
                    $item->name = $currency;
                    $item->value = $data['Valute'][$currency]['Value'];
                    $result[] = $item;
                }
            }
        }

        return $result;
    }
    public  function getStringFromResult(array $items)
    {
        $resultText=[];
        foreach ($items as $item){
            $resultText[$item->name]=$item->value;
        }

        return $resultText;
    }
}
