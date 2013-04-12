<?php

namespace Acme\DemoBundle\Collector;

use Symfony\Component\HttpKernel\DataCollector\DataCollectorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HeadersCollector implements DataCollectorInterface
{
    protected $data;
    protected $request;

    public function collect(Request $request, Response $response, \Exception $exception = null)
    {
        $this->data = (string) $request->headers;
        $this->request = $request;
    }

    public function getHeaders()
    {
        return $this->data;
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function getName()
    {
        return 'acme_headers';
    }
}
