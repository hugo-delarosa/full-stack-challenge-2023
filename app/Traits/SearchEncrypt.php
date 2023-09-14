<?php

namespace App\Traits;

use Exception;
use Illuminate\Support\Facades\Log;

trait SearchEncrypt
{

    public function getSearchables()
    {
        return $this->searchable;
    }

    public function isMatch($value = null)
    {
        if(is_null($value)) {
            return true;
        }

        foreach ($this->getSearchables() as $attribute) {
            if(strpos(strtoupper($this->$attribute),strtoupper($value)) !== false) {
                return true;
            }
        }

        return false;
    }

}