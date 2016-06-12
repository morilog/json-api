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

    public function __construct($dataKey, $data)
    {
        $this->prepare($dataKey, $data, null);
    }

    public function prepare($dataKey = null, $data = null, $pagination = null)
    {
        $this->presenter = (new JsonApiPresenter())
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