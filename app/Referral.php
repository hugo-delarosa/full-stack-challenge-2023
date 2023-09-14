<?php

namespace App;
use App\Traits\EncryptData;
use App\Traits\SearchEncrypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Referral extends Model
{
    use EncryptData, SearchEncrypt;

    protected $fillable = [
        'country',
        'reference_no',
        'organisation',
        'province',
        'district',
        'city',
        'street_address',
        'gps_location',
        'facility_name',
        'facility_type',
        'provider_name',
        'position',
        'phone',
        'email',
        'website',
        'pills_available',
        'code_to_use',
        'type_of_service',
        'note',
        'womens_evaluation',
    ];
    protected $encryptable = [
        'country',
        'reference_no',
        'organisation',
        'province',
        'district',
        'city',
        'street_address',
        'gps_location',
        'facility_name',
        'facility_type',
        'provider_name',
        'position',
        'phone',
        'email',
        'website',
        'pills_available',
        'code_to_use',
        'type_of_service',
        'note',
        'womens_evaluation',
    ];
    protected $searchable = [
        'country',
        'reference_no',
        'organisation',
        'province',
        'district',
        'city',
        'street_address',
        'gps_location',
        'facility_name',
        'facility_type',
        'provider_name',
        'position',
        'phone',
        'email',
        'website',
        'pills_available',
        'code_to_use',
        'type_of_service',
        'note',
        'womens_evaluation',
    ];

}
