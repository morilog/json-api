<?php
namespace Morilog\JsonApi\Responses;

use Illuminate\Contracts\Support\MessageBag;
use Symfony\Component\HttpFoundation\Response;
use Morilog\JsonApi\JsonApiPresenter;
use Morilog\JsonApi\ResponseMessages;
use Morilog\JsonApi\ResponseStatuses;

/**
 * Class ValidationJsonApiResponse
 * @package Morilog\JsonApi\Responses
 */
class ValidationJsonApiResponse extends BaseJsonApiResponse implements JsonApiResponseInterface
{

    /**
     * @var
     */
    protected $presenter;

    /**
     * ValidationJsonApiResponse constructor.
     * @param MessageBag $errors
     */
    public function __construct(MessageBag $errors)
    {
        $this->prepare('errors', $this->normalizeErrors($errors->all()));
    }

    /**
     * @param array $errors
     * @return array
     */
    protected function normalizeErrors(array $errors)
    {
        foreach ($errors as $key => $value) {
            if (is_array($value) && isset($value[0])) {
                $errors[$key] = $value[0];
            }
        }

        return $errors;
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
            ->setData($data)
            ->setDataMainKey($dataKey)
            ->setStatus(ResponseStatuses::FAIL)
            ->setMessage(ResponseMessages::VALIDATION_ERROR)
            ->setStatusCode(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * @return mixed
     */
    public function getResponse()
    {
        return $this->presenter->toJsonResponse();
    }
}