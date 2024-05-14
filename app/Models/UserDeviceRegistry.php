<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class UserDeviceRegistry extends Model
{
    use HasFactory, Notifiable;

    /**
     * Table name of model
     *
     * @var string
     */
    protected $table = 'user_deviceregistry';

    /**
     * Primary key field name of table
     *
     * @var string
     */
    protected $primaryKey = 'deviceregistry_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'device_platform',
        'device_token',
        // 'fcm_token',
        // 'apns_token',
        // 'voip_token',
        'udid',
        'user_id'
    ];


    /**
     * Specifies the user's FCM tokens
     *
     * @return string|array
     */
    public function routeNotificationForFcm()
    {
        return $this->getDeviceTokens();
    }
    

    private function getDeviceTokens()
    {
        return $this->where('user_id', $this->user_id)->pluck('device_token');
    }


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
