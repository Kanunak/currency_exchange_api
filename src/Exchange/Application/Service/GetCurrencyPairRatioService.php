<?php

namespace Kanunak\Exchange\Application\Service;

use Kanunak\Exchange\Domain\CurrencyPairRepository;
use Kanunak\Money\Currency;
use Kanunak\Money\CurrencyPair;

class GetCurrencyPairRatioService
{
    /** @var CurrencyPairRepository  */
    private $currencyPairRepository;

    /**
     * @param CurrencyPairRepository $currencyPairRepository
     */
    public function __construct(CurrencyPairRepository $currencyPairRepository)
    {
        $this->currencyPairRepository = $currencyPairRepository;
    }

    /**
     * @param Currency $currencyFrom
     * @param Currency $currencyTo
     *
     * @return CurrencyPair
     */
    public function execute(Currency $currencyFrom, Currency $currencyTo)
    {
        $ratio = $this->currencyPairRepository->findRatio($currencyFrom, $currencyTo);

        return new CurrencyPair($currencyFrom, $currencyTo, $ratio);
    }
}
