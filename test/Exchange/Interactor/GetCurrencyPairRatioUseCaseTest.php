<?php

namespace Kanunak\test\Exchange\Interactor;

use Kanunak\Exchange\Application\Service\GetCurrencyPairRatioService;
use Kanunak\Exchange\Interactor\GetCurrencyPairRatio\GetCurrencyPairRatioRequest;
use Kanunak\Exchange\Interactor\GetCurrencyPairRatio\GetCurrencyPairRatioResponse;
use Kanunak\Exchange\Interactor\GetCurrencyPairRatio\GetCurrencyPairRatioUseCase;
use Kanunak\Money\Currency;
use Kanunak\Money\CurrencyPair;
use Mockery\MockInterface;

class GetCurrencyPairRatioUseCaseTest extends \PHPUnit_Framework_TestCase
{
    /** @var GetCurrencyPairRatioUseCase  */
    private $useCase;

    /** @var  GetCurrencyPairRatioService|MockInterface */
    private $service;

    protected function setUp()
    {
        $this->service = \Mockery::mock('\Kanunak\Exchange\Application\Service\GetCurrencyPairRatioService');
        $this->useCase = new GetCurrencyPairRatioUseCase($this->service);
    }

    protected function tearDown()
    {
        $this->useCase = null;
        $this->service = null;
    }

    /**
     * @test
     */
    public function itShouldReturnAValidCurrencyPairGivenTwoCurrencies()
    {
        $currencyFrom = new Currency(Currency::CURRENCY_CODE_EURO);
        $currencyTo = new Currency(Currency::CURRENCY_CODE_US_DOLLAR);

        $request = new GetCurrencyPairRatioRequest($currencyFrom, $currencyTo);

        $expectedCurrencyPair = new CurrencyPair($currencyFrom, $currencyTo, 1.5);
        $this->service->shouldReceive('execute')->andReturn($expectedCurrencyPair);

        $expectedResponse = new GetCurrencyPairRatioResponse($expectedCurrencyPair);

        $response = $this->useCase->execute($request);

        $this->assertEquals($expectedResponse->currencyPair(), $response->currencyPair());
    }
}
