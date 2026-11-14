<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PostSlug extends Model
{
    use HasFactory;
	protected $fillable = ['slug', 'post_id'];

	/**
	 * @param $value
	 */
	public function setSlugAttribute( $value ) {
		$this->attributes['slug'] = Str::slug($value);
	}

	public function post(  ) {
		return $this->belongsTo(Post::class);
	}

	/**
	 * @return string
	 */
	public function getRouteKeyName()
	{
		return 'slug';
	}
}
