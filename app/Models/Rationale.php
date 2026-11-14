<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rationale extends Model
{
    use HasFactory;

	protected $fillable = [
		'observed',
		'observed_id',
		'observer_id',
		'course_year',
		'observed_course',
		'strength',
		'organization',
		'purpose',
		'date',
		'user_id',
		'lesson_plan'
	];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function details() {
		return $this->hasMany(RationaleDetail::class, 'rationale_id', 'id');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user(  ) {
		return $this->belongsTo(User::class);
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function observed(  ) {
		return $this->belongsTo(User::class, 'observed_id', 'id');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function observer(  ) {
		return $this->belongsTo(User::class, 'observer_id', 'id');
	}

	protected $dates = ['date', 'created_at', 'updated_at'];
}
