<?php

namespace Kanunak\Exchange\Interactor\GetCurrencyPairRatio;

use Kanunak\Money\CurrencyPair;

class GetCurrencyPairRatioResponse
{
    /** @var  CurrencyPair */
    private $currencyPair;

    /**
     * @param CurrencyPair $currencyPair
     */
    public function __construct(CurrencyPair $currencyPair)
    {
        $this->currencyPair = $currencyPair;
    }

    /**
     * @return CurrencyPair
     */
    public function currencyPair()
    {
        return $this->currencyPair;
    }
}
