<?php

declare(strict_types=1);

namespace App\Services;

use YooKassa\Client;
use YooKassa\Common\Exceptions\ApiConnectionException;
use YooKassa\Common\Exceptions\ApiException;
use YooKassa\Common\Exceptions\AuthorizeException;
use YooKassa\Common\Exceptions\BadApiRequestException;
use YooKassa\Common\Exceptions\ExtensionNotFoundException;
use YooKassa\Common\Exceptions\ForbiddenException;
use YooKassa\Common\Exceptions\InternalServerError;
use YooKassa\Common\Exceptions\NotFoundException;
use YooKassa\Common\Exceptions\ResponseProcessingException;
use YooKassa\Common\Exceptions\TooManyRequestsException;
use YooKassa\Common\Exceptions\UnauthorizedException;
use YooKassa\Request\Payments\CreatePaymentResponse;

class YooMoneyService
{
    private Client $client;

    public function __construct()
    {
        $shopId = env('YOOMONEY_SHOP_ID');
        $shopKey = env('YOOMONEY_KEY');
        $this->client = new Client();
        $this->client->setAuth($shopId, $shopKey);
    }

    public function getPaymentInfo(string $paymentId)
    {
        try {
            $response = $this->client->getPaymentInfo($paymentId);
        } catch (\Exception $e) {
            $response = $e;
        }

        return $response;
    }

    public function getSbpBanks()
    {
        try {
            $result = $this->client->getSbpBanks();
        } catch (\Exception $e) {
            $result = $e;
        }

        return $result;
    }

    /**
     * @param  array  $data
     *
     * @return CreatePaymentResponse|null
     *
     * @throws ApiConnectionException
     * @throws ApiException
     * @throws AuthorizeException
     * @throws BadApiRequestException
     * @throws ExtensionNotFoundException
     * @throws ForbiddenException
     * @throws InternalServerError
     * @throws NotFoundException
     * @throws ResponseProcessingException
     * @throws TooManyRequestsException
     * @throws UnauthorizedException
     */
    public function setPayment(array $data)
    {
        $idempotenceKey = $this->generateIdempotenceKey();
        $response = $this->client->createPayment($data, $idempotenceKey
        );

        //get confirmation url
        $confirmationUrl = $response->getConfirmation()->getConfirmationUrl();

        return $response;
    }

    /**
     * @return string
     */
    private function generateIdempotenceKey(): string
    {
        return uniqid('', true);
    }
}
