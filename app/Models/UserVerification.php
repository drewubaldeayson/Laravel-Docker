<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserVerification extends Model
{
    use HasFactory;

    /**
     * Table name of model
     *
     * @var string
     */
    protected $table = 'user_verification';

    /**
     * Primary key field name of table
     *
     * @var string
     */
    protected $primaryKey = 'verification_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'type',
        'otp_number',
        'attempts',
        'verification_code',
        'expire_at',
        'status'
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
