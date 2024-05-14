<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;

    /**
     * Table name of model
     *
     * @var string
     */
    protected $table = 'user_role';

    /**
     * Primary key field name of table
     *
     * @var string
     */
    protected $primaryKey = 'user_role_id';

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
