<?php
namespace OtcCms\Models;

use Validator;
/**
 * Created by PhpStorm.
 * User: pengchi
 * Date: 10/30/17
 * Time: 3:11 PM
 */
trait Validatable
{
    private $errors;

    public function validate($data)
    {
        $v = Validator::make($data, $this->rules);
        if ($v->fails()) {
            $this->errors = $v->errors()->all();
            return false;
        }
        $this->errors = [];
        return true;
    }

    public function errors()
    {
        return $this->errors;
    }
}
