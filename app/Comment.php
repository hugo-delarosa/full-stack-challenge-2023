<?php

namespace App;

use App\Traits\EncryptData;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use EncryptData;

    protected $encryptable = [
        'text',
    ];
}
