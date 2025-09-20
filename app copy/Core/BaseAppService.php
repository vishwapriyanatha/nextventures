<?php

namespace App\Core;

use App\Core\Contracts\BaseServiceInterface;

class BaseAppService implements BaseServiceInterface
{
    protected $errors;

    public function setErrors($errs)
    {
        $this->errors = $errs;
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
