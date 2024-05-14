<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddresses extends Model
{
    use HasFactory;

    /**
     * Table name of model
     *
     * @var string
     */
    protected $table = 'user_adresses';

    /**
     * Primary key field name of table
     *
     * @var string
     */
    protected $primaryKey = 'address_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'region_code',
        'province_code',
        'city_code',
        'brgy_code',
        'region',
        'province',
        'city',
        'brgy',
        'address',
        'landmark',
        'zip_code',
        'longtitude',
        'latitude',
        'contact_number',
        'is_default'
    ];

    /**
     * Additional fields from other connected tables
     *
     * @var array
     */
    protected $appends = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['created_at','updated_at'];
}
