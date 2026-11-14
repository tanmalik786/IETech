<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObservationDetail extends Model
{
    use HasFactory;

	protected $fillable = [
		'activity',
		'response',
		'step',
		'parent_id',
		'observation_id'
	];

	public function observation(  ) {
		return $this->belongsTo(Observation::class);
	}

	public function observationStep() {
		return $this->belongsTo(ObservationStep::class);
	}

	public function subActivity(  ) {
		return $this->hasMany(ObservationDetail::class, 'parent_id', 'id');
	}
}
