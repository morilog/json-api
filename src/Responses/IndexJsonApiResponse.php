<?php
namespace Morilog\JsonApi\Responses;

use Symfony\Component\HttpFoundation\Response;
use Morilog\JsonApi\JsonApiPresenter;
use Morilog\JsonApi\ResponseMessages;
use Morilog\JsonApi\ResponseStatuses;

class IndexJsonApiResponse extends BaseJsonApiResponse implements JsonApiResponseInterface
{
    /**
     * @var JsonApiPresenter
     */
    protected $presenter;

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
            ->setMessage(ResponseMessages::FOUND)
            ->setDataMainKey($dataKey)
            ->setData($data)
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getResponse()
    {
        return $this->presenter->toJsonResponse();
    }
}