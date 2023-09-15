<?php

namespace App;

use App\Traits\EncryptData;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use EncryptData;
    protected $encryptable = [
        'name',
        'slug',
        'description'
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

    public function setSlugAttribute($value)
    {
        $separator = '-';

        // Convert all dashes/underscores into separator
        $value = preg_replace('!['.preg_quote($separator).']+!u', $separator, $value);

        // Replace @ with the word 'at'
        $value = str_replace('@', $separator.'at'.$separator, $value);

        // Remove all characters that are not the separator, letters, numbers, or whitespace.
        $value = preg_replace('![^'.preg_quote($separator).'\pL\pN\s]+!u', '', static::lower($value));

        // Replace all separator characters and whitespace by a single separator
        $value = preg_replace('!['.preg_quote($separator).'\s]+!u', $separator, $value);

        return trim($value, $separator);
    }

}
