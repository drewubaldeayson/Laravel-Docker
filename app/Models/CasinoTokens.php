<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CasinoTokens extends Model
{
    use HasFactory;

    /**
     * Table name of model
     *
     * @var string
     */
    protected $table = 'ts_api_casino_tokens';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'casino_id',
        'country_iso',
        'allowed_ips',
        'allowed_domains',
        'is_active',
        'api_key',
        'secret_key',
        'type',
        'wallet_url',
        'modify_uid',
        'create_dt',
        'modify_dt'
    ];


    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'create_dt' => 'datetime',
        'modify_dt' => 'datetime'
    ];
}
