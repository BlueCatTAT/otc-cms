<?php
/**
 * Created by PhpStorm.
 * User: pengchi
 * Date: 11/3/17
 * Time: 3:00 PM
 */

namespace OtcCms\Models;

interface NumericCodeInterface
{
    /**
     * @return int
     */
    public function getCode();

    /**
     * @return string
     */
    public function getText();
}
