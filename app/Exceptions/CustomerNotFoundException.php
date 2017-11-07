<?php
/**
 * Created by PhpStorm.
 * User: mc
 * Date: 07/11/2017
 * Time: 9:46 AM
 */

namespace OtcCms\Exceptions;


use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CustomerNotFoundException extends NotFoundHttpException
{
    protected $message = '未找到客户';
}