<?php

namespace App;

use App\Traits\EncryptData;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use EncryptData;

    protected $encryptable = [
      'name',
    ];

    const ADMIN = 'admin';

    public function permissions()
    {
        return $this->belongsToMany('App\Permission');
    }

    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
