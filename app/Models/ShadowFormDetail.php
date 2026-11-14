<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShadowFormDetail extends Model
{
    use HasFactory;

	protected $fillable = [
		'activity',
		'response',
		'step',
		'shadow_form_id'
	];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function observation(  ): \Illuminate\Database\Eloquent\Relations\BelongsTo {
		return $this->belongsTo(Observation::class);
	}
}
