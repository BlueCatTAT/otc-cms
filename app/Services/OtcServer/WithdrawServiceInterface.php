<?php
/**
 * Created by PhpStorm.
 * User: pengchi
 * Date: 11/1/17
 * Time: 4:53 PM
 */

namespace OtcCms\Services\OtcServer;

use OtcCms\Models\Withdraw;

interface WithdrawServiceInterface
{
    /**
     * @param Withdraw $withdraw
     * @return Result
     */
    public function confirm(Withdraw $withdraw);

    /**
     * @param Withdraw $withdraw
     * @param string $comment
     * @return Result
     */
    public function deny(Withdraw $withdraw, $comment);
}
