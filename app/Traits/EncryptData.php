<?php

namespace App\Traits;

use Exception;
use Illuminate\Support\Facades\Log;

trait EncryptData
{
    protected $enableEncryption = true;

    public function isEncryptable($key)
    {
        if($this->enableEncryption){
            return in_array($key, $this->encryptable);
        }

        return false;
    }

    public function setAttribute($key, $value)
    {

        if (
            $this->isEncryptable($key) &&
            (!is_null($value) && $value != '') &&
            (in_array($key, $this->getFillable()))
        )
        {
            try {
                $value = encrypt($value);
                $this->attributes[$key] = $value;
            } catch (Exception $th) {}
        }

        return parent::setAttribute($key, $value);
    }

    public function getAttribute($key)
    {
        $value = parent::getAttribute($key);
        if (
            $this->isEncryptable($key) &&
            (in_array($key, $this->getFillable()))
        )
        {
            try {
                $value = decrypt($value);
            } catch (Exception $th) {}
        }
        return $value;
    }

}