<?php
/**
 * Created by PhpStorm.
 * User: mc
 * Date: 06/11/2017
 * Time: 3:06 PM
 */

namespace OtcCms\Services\Repositories\Withdraw;


use OtcCms\Models\Withdraw;

interface WithdrawRepositoryInterface
{
    /**
     * @param Withdraw $withdraw
     * @return boolean
     */
    public function confirm(Withdraw $withdraw);

    /**
     * @param Withdraw $withdraw
     * @param $comment
     * @return boolean
     */
    public function deny(Withdraw $withdraw, $comment);
}