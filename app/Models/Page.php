<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'content',
        'category',
        'user_id',
	    'status',
	    'institute_id'
    ];

	public function sections() {
		return $this->hasMany(Section::class);
	}

	/**
	 * @return string
	 */
	public function getRouteKeyName()
	{
		return 'slug';
	}
}
