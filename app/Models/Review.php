<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

	protected $fillable = [
		'stage',
		'user_id'
	];

	public function feedback(  ) {
		return $this->hasMany(ReviewFeedback::class, 'review_id', 'id');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function details() {
		return $this->hasMany(ReviewDetail::class, 'review_id', 'id');
	}
}
