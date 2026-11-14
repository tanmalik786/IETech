<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpertObservation extends Model
{
    use HasFactory;
	protected $fillable = [
		'observer_id', 'observed_id', 'date', 'user_id'
	];

	public $dates = ['date'];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function details(  ): \Illuminate\Database\Eloquent\Relations\HasMany {
		return $this->hasMany(ExpertObservationDetail::class);
	}


	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function observer(  ): \Illuminate\Database\Eloquent\Relations\BelongsTo {
		return $this->belongsTo(User::class, 'observer_id', 'id');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function observed(  ): \Illuminate\Database\Eloquent\Relations\BelongsTo {
		return $this->belongsTo(User::class, 'observed_id', 'id');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user(  ) {
		return $this->belongsTo(User::class, 'user_id', 'id');
	}
}
