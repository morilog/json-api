<?php
namespace Morilog\JsonApi;

use Illuminate\Http\JsonResponse;

/**
 * Class JsonApiPresenter
 * @package Morilog\JsonApi\ValueObjects
 */
class JsonApiPresenter
{
    /**
     * @var string
     */
    private $status = ResponseStatuses::ERROR;

    /**
     * @var string
     */
    private $message = '';

    /**
     * @var string
     */
    private $description = '';

    /**
     * @var array
     */
    private $data = [];

    /**
     * @var
     */
    private $dataMainKey;

    /**
     * @var int
     */
    private $statusCode = 400;


    private $pagination = [];

    /**
     * @param mixed $status
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @param mixed $message
     * @return $this
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @param mixed $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }


    /**
     * @param mixed $data
     * @return $this
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @return array
     */
    public function getData()
    {
        if (null === $this->getDataMainKey()) {
            return null;
        }

        $data = [
            $this->getDataMainKey() => $this->data,
            'mainKey' => $this->getDataMainKey(),
        ];

        return $data;
    }

    /**
     * @param mixed $statusCode
     * @return $this
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * @return JsonResponse
     */
    public function toJsonResponse()
    {
        return new JsonResponse($this->toArray(), $this->statusCode);
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $response = [
            'status' => $this->status,
            'message' => $this->message,
            'data' => $this->getData()
        ];

        $pagination = $this->getPagination();
        if (!empty($pagination)) {
            $response['pagination'] = [
                "total" => $pagination['total'],
                "per_page" => $pagination['per_page'],
                "current_page" => $pagination['current_page'],
                "last_page" => $pagination['last_page'],
                "next_page_url" => $pagination['next_page_url'],
                "prev_page_url" => $pagination['prev_page_url'],
                "from" => $pagination['from'],
                "to" => $pagination['to'],
            ];
        }

        

        if (null === $response['data']) {
            unset($response['data']);
        }

        return $response;
    }

    /**
     * @return mixed
     */
    public function getDataMainKey()
    {
        return $this->dataMainKey;
    }

    /**
     * @param mixed $dataMainKey
     * @return $this
     */
    public function setDataMainKey($dataMainKey)
    {
        $this->dataMainKey = $dataMainKey;

        return $this;
    }

    /**
     * @return array
     */
    public function getPagination()
    {
        return $this->pagination;
    }

    /**
     * @param array $pagination
     * @return $this
     */
    public function setPagination($pagination)
    {
        $this->pagination = $pagination;

        return $this;
    }
}