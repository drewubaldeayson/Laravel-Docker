<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Players extends Model
{
    use HasFactory;

    /**
     * Table name of model
     *
     * @var string
     */
    protected $table = 'ts_api_players';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'casino_user_id',
        'casino_id',
        'username',
        'unique_id',
        'is_blocked',
        'currencies',
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
