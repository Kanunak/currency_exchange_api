<?php

namespace Kanunak\Bundle\ApiBundle\Controller\Exchange;

use FOS\RestBundle\Controller\FOSRestController;
use Kanunak\Exchange\Interactor\GetCurrencyPairRatio\GetCurrencyPairRatioRequest;
use Kanunak\Money\Currency;
use Symfony\Component\HttpFoundation\Request;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations\Get;

class ExchangeController extends FOSRestController
{
    /**
     * Gets a list of all the game shops. The list can be paginated using querystring paramers: "page" and "limit".
     *
     * @ApiDoc(
     *  description = "Lists all the game shops",
     *  resource = true,
     *  requirements = {
     *    { "name"="currencyCodeFrom", "dataType"="string", "description"="Code of the currency from"},
     *    { "name"="currencyCodeTo", "dataType"="string", "description"="Code of the currency to"}
     *  }
     * )
     * @Get("/ratio/{currencyCodeFrom}/{currencyCodeTo}")
     *
     * @param string  $currencyCodeFrom
     * @param string  $currencyCodeTo
     * @param Request $request
     *
     * @return Response
     */
    public function getRatioBetweenCurrenciesAction($currencyCodeFrom, $currencyCodeTo, Request $request)
    {
        try {
            $useCaseRequest =
                new GetCurrencyPairRatioRequest(new Currency($currencyCodeFrom), new Currency($currencyCodeTo));
        } catch (\InvalidArgumentException $e) {
            return new Response('Currency code is not valid', Response::HTTP_BAD_REQUEST);
        }

        $useCase = $this->get('kanunak.exchange.interactor.get_currency_pair_ratio.get_currency_pair_ratio_use_case');

        $useCaseResponse = $useCase->execute($useCaseRequest);

        $currencyPair = $this
            ->get('kanunak.exchange.infrastructure.ui.presenter.get_currency_pair_ratio.api.currency_pair_presenter')
            ->present($useCaseResponse)
        ;

        return new Response(json_encode($currencyPair));
    }
}
