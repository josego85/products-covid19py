<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $table = 'contact';

	public function products()
	{
		return $this->hasMany('App\Model2\Product', 'id_');
	}
}
