<?php

namespace Kanunak\Exchange\Domain;

use Kanunak\Money\Currency;

interface CurrencyPairRepository
{
    /**
     * @param Currency $currencyFrom
     * @param Currency $currencyTo
     *
     * @return float
     */
    public function findRatio(Currency $currencyFrom, Currency $currencyTo);
}
