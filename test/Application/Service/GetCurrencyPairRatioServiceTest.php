<?php

namespace Kanunak\Test\Exchange\Application\Service;

use Kanunak\Exchange\Application\Service\GetCurrencyPairRatioService;
use Kanunak\Exchange\Domain\CurrencyPairRepository;
use Kanunak\Money\Currency;
use Kanunak\Money\CurrencyPair;
use Mockery\MockInterface;

class GetCurrencyPairRatioServiceTest extends \PHPUnit_Framework_TestCase
{
    /** @var GetCurrencyPairRatioService  */
    private $service;

    /** @var  CurrencyPairRepository|MockInterface */
    private $repository;

    protected function setUp()
    {
        $this->repository = \Mockery::mock('Kanunak\Exchange\Domain\CurrencyPairRepository');
        $this->service = new GetCurrencyPairRatioService($this->repository);
    }

    protected function tearDown()
    {
        $this->service = null;
        $this->repository = null;
    }

    /**
     * @test
     */
    public function itShouldReturnACurrencyPairAfterGettingTheRatioFromTheRepository()
    {
        $currencyFrom = new Currency(Currency::CURRENCY_CODE_EURO);
        $currencyTo = new Currency(Currency::CURRENCY_CODE_US_DOLLAR);
        $ratio = 1.5;

        $this->repository->shouldReceive('findRatio')->andReturn($ratio);

        $expectedCurrencyPair = new CurrencyPair($currencyFrom, $currencyTo, $ratio);

        $currencyPair = $this->service->execute($currencyFrom, $currencyTo);

        $this->assertEquals($expectedCurrencyPair, $currencyPair);
    }
}
