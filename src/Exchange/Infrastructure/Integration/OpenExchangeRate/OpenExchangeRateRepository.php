<?php

namespace Kanunak\Exchange\Infrastructure\Integration\OpenExchangeRate;

use Kanunak\Exchange\Domain\CurrencyPairRepository;
use Kanunak\Money\Currency;

class OpenExchangeRateRepository implements CurrencyPairRepository
{
    const OPEN_EXCHANGE_URL = 'https://openexchangerates.org/api/latest.json?app_id=a9c07259424e4a6a9a41f5a5f5564018';

    private $ratesData;
    /**
     * @param Currency $currencyFrom
     * @param Currency $currencyTo
     *
     * @return float
     */
    public function findRatio(Currency $currencyFrom, Currency $currencyTo)
    {
        $ratioFrom = $this->getRatioFromCurrency($currencyFrom);
        $ratioTo = $this->getRatioFromCurrency($currencyTo);

        return $this->calculateCombinedRatio($ratioFrom, $ratioTo);
    }

    /**
     * @return array
     */
    private function calculateRatesBasedOnUSDollars()
    {
        if ($this->ratesData) {
            return $this->ratesData;
        }
        $contents = file_get_contents(self::OPEN_EXCHANGE_URL);
        $data = (json_decode($contents, true));

        $this->ratesData = $data['rates'];

        return $this->ratesData;
    }

    /**
     * @param Currency $currency
     *
     * @return float
     */
    private function getRatioFromCurrency(Currency $currency)
    {
        $this->calculateRatesBasedOnUSDollars();

        return (float) $this->ratesData[$currency->code()];
    }

    /**
     * @param $ratioFrom
     * @param $ratioTo
     *
     * @return float
     */
    private function calculateCombinedRatio($ratioFrom, $ratioTo)
    {
        return (float) ($ratioTo / $ratioFrom);
    }
}
