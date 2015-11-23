<?php

namespace Kanunak\Exchange\Infrastructure\UI\Presenter\GetCurrencyPairRatio\Api;

use JsonSerializable;
use Kanunak\Money\CurrencyPair;

class CurrencyPairResource implements JsonSerializable
{
    private $currencyPair;

    public function __construct(CurrencyPair $currencyPair)
    {
        $this->currencyPair = $currencyPair;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'currency_from' => $this->currencyPair->currencyFrom()->code(),
            'currency_to' => $this->currencyPair->currencyTo()->code(),
            'ratio' => $this->currencyPair->ratio(),
        ];
    }
}
