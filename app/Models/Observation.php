<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Observation extends Model
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

	/**
	 * @param $query
	 *
	 * @return mixed
	 */
	public function scopeMine($query) {
		return $query->where('user_id', auth()->id());
	}

	public function type() {
		return $this->belongsTo(ObservationType::class, 'observation_type_id');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function details() {
		return $this->hasMany(ObservationDetail::class);
	}

	public function remarks(  ) {
		return $this->hasMany(ObservationDetail::class)->where('activity', 'Comments');
	}

	protected $dates = ['date', 'created_at', 'updated_at'];


}
