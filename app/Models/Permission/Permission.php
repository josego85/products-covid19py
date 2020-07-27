<?php

namespace App\Models\Permission;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    protected $fillable = [
        'name', 'slug', 'description',
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Models\Permission\Role');
    }
}
