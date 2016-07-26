<?php
namespace Morilog\JsonApi\Responses;

use Morilog\JsonApi\JsonApiPresenter;
use Morilog\JsonApi\ResponseMessages;
use Morilog\JsonApi\ResponseStatuses;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class DestroyJsonApiResponse
 * @package Morilog\JsonApi\Responses
 */
class DestroyJsonApiResponse extends BaseJsonApiResponse implements JsonApiResponseInterface
{
    /**
     * @var JsonApiPresenter
     */
    protected $presenter;

    /**
     * DestroyJsonApiResponse constructor.
     */
    public function __construct()
    {
        $this->prepare(null, null, null);
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
            ->setMessage(ResponseMessages::DELETED)
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getResponse()
    {
        return $this->presenter->toJsonResponse();
    }
}