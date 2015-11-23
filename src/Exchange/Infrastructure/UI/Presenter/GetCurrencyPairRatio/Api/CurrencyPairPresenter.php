<?php

namespace Kanunak\Exchange\Infrastructure\UI\Presenter\GetCurrencyPairRatio\Api;

use Kanunak\Exchange\Interactor\GetCurrencyPairRatio\GetCurrencyPairRatioPresenter as PresenterInterface;
use Kanunak\Exchange\Interactor\GetCurrencyPairRatio\GetCurrencyPairRatioResponse;

class CurrencyPairPresenter implements PresenterInterface
{
    /**
     * @param GetCurrencyPairRatioResponse $response
     *
     * @return mixed
     */
    public function present(GetCurrencyPairRatioResponse $response)
    {
        return new CurrencyPairResource($response->currencyPair());
    }
}
