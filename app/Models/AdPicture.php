<?php
/**
 * Created by PhpStorm.
 * User: mc
 * Date: 15/12/2017
 * Time: 2:46 PM
 */
namespace OtcCms\Models;

use Illuminate\Support\Facades\Redis;

class AdPicture
{
    private $filename;

    private function __construct($filename)
    {
        $this->filename = $filename;
    }

    public static function findAll()
    {
        $data = Redis::get('ad_pictures');
        if (empty($data)) {
            return [];
        }
        return array_map(function($value) {
            return new self($value['filename']);
        }, $data);
    }
}