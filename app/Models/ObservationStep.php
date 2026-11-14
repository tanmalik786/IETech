<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObservationStep extends Model
{
    use HasFactory;
	protected $fillable = ['name', 'slug', 'user_id'];

	/**
	 * @return string
	 */
	public function getRouteKeyName()
	{
		return 'slug';
	}

}
