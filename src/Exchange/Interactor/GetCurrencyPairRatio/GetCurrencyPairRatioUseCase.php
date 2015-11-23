<?php

namespace Kanunak\Exchange\Interactor\GetCurrencyPairRatio;

use Kanunak\Exchange\Application\Service\GetCurrencyPairRatioService;

class GetCurrencyPairRatioUseCase
{
    /** @var GetCurrencyPairRatioService  */
    private $service;

    /**
     * @param GetCurrencyPairRatioService $service
     */
    public function __construct(GetCurrencyPairRatioService $service)
    {
        $this->service = $service;
    }

    /**
     * @param GetCurrencyPairRatioRequest $request
     *
     * @return GetCurrencyPairRatioResponse
     */
    public function execute(GetCurrencyPairRatioRequest $request)
    {
        $currencyPair = $this->service->execute($request->currencyFrom(), $request->currencyTo());

        return new GetCurrencyPairRatioResponse($currencyPair);
    }
}
