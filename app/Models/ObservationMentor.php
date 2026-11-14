<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObservationMentor extends Model
{
    use HasFactory;

	protected $fillable = [
		'observer_id',
		'observed_id',
		'user_id',
		'observation_id',
		'course_year',
		'observed_course',
		'strength',
		'organization',
		'date'
	];

	public function observation(  ) {
		return $this->belongsTo(Observation::class, 'observation_id', 'id');
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
	public function observed() {
		return $this->belongsTo(User::class, 'observed_id', 'id');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function observer() {
		return $this->belongsTo(User::class, 'observer_id', 'id');
	}

	protected $dates = ['date', 'created_at', 'updated_at'];
}
