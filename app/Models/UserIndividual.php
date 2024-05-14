<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserIndividual extends Model
{
    use HasFactory;

    /**
     * Table name of model
     *
     * @var string
     */
    protected $table = 'user_individual';

    /**
     * Primary key field name of table
     *
     * @var string
     */
    protected $primaryKey = 'user_individual_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'customer_type',
        'status',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'user_id', 'user_id');
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
