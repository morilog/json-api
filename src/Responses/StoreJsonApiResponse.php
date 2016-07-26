<?php
namespace Morilog\JsonApi\Responses;

use Illuminate\Http\Response;
use Morilog\JsonApi\JsonApiPresenter;
use Morilog\JsonApi\ResponseMessages;
use Morilog\JsonApi\ResponseStatuses;

/**
 * Class StoreJsonApiResponse
 * @package Morilog\JsonApi\Responses
 */
class StoreJsonApiResponse extends BaseJsonApiResponse implements JsonApiResponseInterface
{
    /**
     * @var JsonApiPresenter
     */
    protected $presenter;

    /**
     * StoreJsonApiResponse constructor.
     * @param $dataKey
     * @param $data
     * @param null $extraData
     */
    public function __construct($dataKey, $data, $extraData = null)
    {
        $this->prepare($dataKey, $data, null, $extraData);
    }

    /**
     * @param null $dataKey
     * @param null $data
     * @param null $pagination
     * @param null $extraData
     */
    public function prepare($dataKey = null, $data = null, $pagination = null, $extraData = null)
    {
        $this->presenter = (new JsonApiPresenter())
            ->setExtraData($extraData)
            ->setStatus(ResponseStatuses::SUCCESS)
            ->setMessage(ResponseMessages::STORED)
            ->setDataMainKey($dataKey)
            ->setData($data)
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getResponse()
    {
        return $this->presenter->toJsonResponse();
    }
}