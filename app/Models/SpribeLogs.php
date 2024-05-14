<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpribeLogs extends Model
{
    use HasFactory;

    /**
     * Table name of model
     *
     * @var string
     */
    protected $table = 'ts_api_spribe_logs';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'is_request',
        'requestId',
        'gameRoundCode',
        'transactionCode',
        'externalToken',
        'internal_transaction_key',
        'body',
        'type',
        'modify_uid'
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
