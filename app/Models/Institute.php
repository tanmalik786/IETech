<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institute extends Model
{
	protected $fillable = ['name','slug'];
    use HasFactory;

	/**
	 * @return string
	 */
	public function getRouteKeyName()
	{
		return 'slug';
	}

	public function users(  ) {
		return $this->hasMany(User::class);
	}

}
