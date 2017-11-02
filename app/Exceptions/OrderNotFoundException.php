<?php

namespace OtcCms\Exceptions;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class OrderNotFoundException extends NotFoundHttpException
{
    protected $message = '无法找到订单';
}
