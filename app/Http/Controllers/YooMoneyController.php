<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\YooMoneyService;
use Illuminate\Support\Facades\Request;
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

class YooMoneyController extends Controller
{
    private YooMoneyService $service;
    public function __construct()
    {
        $this->service = new YooMoneyService();
    }
    public function getPaymentInfo(string $paymentId)
    {
        return $this->service->getPaymentInfo($paymentId);
    }

    public function getSpbBanks()
    {
        return $this->service->getSbpBanks();
    }

    /**
     * @param  Request  $request
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
    public function setPayment(Request $request): ?CreatePaymentResponse
    {
        if ($request::isJson()) {
            $data = $request::all();
        }

        return $this->service->setPayment($data);
    }
}
