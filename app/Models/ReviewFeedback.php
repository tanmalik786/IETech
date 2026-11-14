<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewFeedback extends Model
{
    use HasFactory;

	protected $table = 'review_feedback';

	protected $fillable = [
		'review_id',
		'step',
		'user_id',
		'feedback'
	];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function review(  ) {
		return $this->belongsTo(Review::class, 'review_id', 'id');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user(  ) {
		return $this->belongsTo(User::class, 'user_id', 'id');
	}
}
