<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpertObservationDetail extends Model
{
    use HasFactory;
	protected $fillable = [
		'activity', 'response', 'expert_observation_id'
	];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function expertObservation(  ): \Illuminate\Database\Eloquent\Relations\BelongsTo {
		return $this->belongsTo(ExpertObservation::class, 'expert_observation_id', 'id');
	}
}
