<?php

namespace Kanunak\Exchange\Interactor\GetCurrencyPairRatio;

use Kanunak\Money\Currency;

class GetCurrencyPairRatioRequest
{
    /** @var  Currency */
    private $currencyFrom;

    /** @var  Currency */
    private $currencyTo;

    /**
     * @param Currency $currencyFrom
     * @param Currency $currencyTo
     */
    public function __construct(Currency $currencyFrom, Currency $currencyTo)
    {
        $this->currencyFrom = $currencyFrom;
        $this->currencyTo = $currencyTo;
    }

    /**
     * @return Currency
     */
    public function currencyFrom()
    {
        return $this->currencyFrom;
    }

    /**
     * @return Currency
     */
    public function currencyTo()
    {
        return $this->currencyTo;
    }
}
