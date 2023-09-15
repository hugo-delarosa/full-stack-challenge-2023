<?php

namespace App;

use App\Traits\EncryptData;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use EncryptData;

    protected $fillable = [
        'text',
        'referral_id',
        'user_id'
    ];

    protected $encryptable = [
        'text',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function referral()
    {
        return $this->belongsTo(Referral::class);
    }

}
