<?php
/**
 * Created by PhpStorm.
 * User: pengchi
 * Date: 11/1/17
 * Time: 4:53 PM
 */

namespace OtcCms\Services\OtcServer;

interface WithdrawInterface
{
    /**
     * @param int $withdrawId
     * @return bool
     */
    public function confirm($withdrawId);

    /**
     * @param int $withdrawId
     * @return bool
     */
    public function deny($withdrawId);
}
