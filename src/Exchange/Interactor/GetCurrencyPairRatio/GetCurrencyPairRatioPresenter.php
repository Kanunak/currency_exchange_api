<?php

namespace Kanunak\Exchange\Interactor\GetCurrencyPairRatio;

interface GetCurrencyPairRatioPresenter
{
    /**
     * @param GetCurrencyPairRatioResponse $response
     *
     * @return mixed
     */
    public function present(GetCurrencyPairRatioResponse $response);
}
