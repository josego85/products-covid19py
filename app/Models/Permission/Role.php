<?php

namespace App\Models\Permission;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    protected $fillable = [
        'name', 'slug', 'description', 'full-access',
    ];

    public function users()
    {
        return $this->belongsToMany('App\Models\Permission\Role');
    }

    public function permissions()
    {
        return $this->belongsToMany('App\Models\Permission\Permission');
    }
}