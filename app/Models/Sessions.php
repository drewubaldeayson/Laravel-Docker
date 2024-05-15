<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sessions extends Model
{
    use HasFactory;

    /**
     * Table name of model
     *
     * @var string
     */
    protected $table = 'ts_api_sessions';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'request_token',
        'initial_session',
        'session',
        'api_key',
        'casino_id',
        'player_id',
        'provider_id',
        'is_active',
        'game_name',
        'status',
        'url',
        'error',
        'is_demo',
        'free_spin',
        'free_spin_played',
        'free_spin_token',
        'free_spin_activated',
        'device',
        'lang',
        'currency',
        'provider',
        'parent_provider',
        'modify_uid',
        'create_dt',
        'modify_dt',
        'is_lobby'
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
