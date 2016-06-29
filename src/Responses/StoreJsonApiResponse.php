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
     */
    public function __construct($dataKey, $data)
    {
        $this->prepare($dataKey, $data, null);
    }

    /**
     * @param null $dataKey
     * @param null $data
     * @param null $pagination
     */
    public function prepare($dataKey = null, $data = null, $pagination = null)
    {
        $this->presenter = (new JsonApiPresenter())
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