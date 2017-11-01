<?php

namespace OtcCms\Exceptions;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class WithdrawNotFoundException extends NotFoundHttpException
{
    protected $message = '无法找到提币记录';
}
