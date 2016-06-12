<?php
namespace Morilog\JsonApi\Responses;

use Symfony\Component\HttpFoundation\Response;
use Morilog\JsonApi\JsonApiPresenter;
use Morilog\JsonApi\ResponseMessages;
use Morilog\JsonApi\ResponseStatuses;

/**
 * Class PaginationJsonApiResponse
 * @package Morilog\JsonApi\Responses
 */
class PaginationJsonApiResponse extends BaseJsonApiResponse implements JsonApiResponseInterface
{
    /**
     * @var JsonApiPresenter
     */
    protected $presenter;

    /**
     * PaginationJsonApiResponse constructor.
     * @param $dataKey
     * @param $data
     * @param null $pagination
     */
    public function __construct($dataKey, $data, $pagination = null)
    {
        $this->prepare($dataKey, $data, $pagination);
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
            ->setMessage(ResponseMessages::FOUND)
            ->setDataMainKey($dataKey)
            ->setData($data)
            ->setPagination($pagination)
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