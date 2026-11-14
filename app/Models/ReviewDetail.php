<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewDetail extends Model
{
    use HasFactory;

	protected $fillable = [
		'activity',
		'response',
		'step',
		'parent_id',
		'review_id'
	];


	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function review() {
		return $this->belongsTo(Review::class);
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function subActivity() {
		return $this->hasMany(ReviewDetail::class, 'parent_id', 'id');
	}
}
