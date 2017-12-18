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
    private static $dataKey = 'ad_pictures';

    private function __construct($filename)
    {
        $this->filename = $filename;
    }

    public static function findAll()
    {
        $data = Redis::get(self::$dataKey);
        if (empty($data)) {
            return [];
        }
        $data = @json_decode($data, true);
        return array_map(function($value) {
            return new self($value);
        }, $data);
    }

    public static function create($filename)
    {
        return new self($filename);
    }

    public static function reset(array $filenames)
    {
        Redis::set(self::$dataKey, json_encode($filenames));
    }

    public function save()
    {
        $data = Redis::get(self::$dataKey);
        $data = @json_decode($data, true);
        if (empty($data)) {
            $data = [];
        }
        $data = array_merge($data, [ $this->filename ]);
        Redis::set(self::$dataKey, json_encode($data));
    }

    public function getUrl()
    {
        return $this->filename;
    }
}