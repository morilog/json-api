<?php
namespace Morilog\JsonApi\Responses;

use Symfony\Component\HttpFoundation\Response;
use Morilog\JsonApi\JsonApiPresenter;
use Morilog\JsonApi\ResponseMessages;
use Morilog\JsonApi\ResponseStatuses;

/**
 * Class UpdateJsonApiResponse
 * @package Morilog\JsonApi\Responses
 */
class UpdateJsonApiResponse extends BaseJsonApiResponse implements JsonApiResponseInterface
{
    /**
     * @var JsonApiPresenter
     */
    protected $presenter;

    /**
     * UpdateJsonApiResponse constructor.
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
            ->setMessage(ResponseMessages::UPDATED)
            ->setStatusCode(Response::HTTP_ACCEPTED);

        if ($dataKey !== null) {
            $this->presenter
                ->setData($data)
                ->setDataMainKey($dataKey);
        }
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getResponse()
    {
        return $this->presenter->toJsonResponse();
    }
}