<?php
namespace Morilog\JsonApi\Responses;

use Symfony\Component\HttpFoundation\Response;
use Morilog\JsonApi\JsonApiPresenter;
use Morilog\JsonApi\ResponseMessages;
use Morilog\JsonApi\ResponseStatuses;

/**
 * Class RecoverJsonApiResponse
 * @package Morilog\JsonApi\Responses
 */
class RecoverJsonApiResponse extends BaseJsonApiResponse implements JsonApiResponseInterface
{
    /**
     * @var JsonApiPresenter
     */
    protected $presenter;

    /**
     * RecoverJsonApiResponse constructor.
     */
    public function __construct()
    {
        $this->prepare(null, null, null);
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
            ->setMessage(ResponseMessages::RESTORED)
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