<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShadowForm extends Model
{
	use HasFactory;
	protected $fillable = [
		'year_group',
		'date',
		'time',
		'number_of_students',
		'course_title',
		'topic',
		'ability',
		'pre_req',
		'outcome',
		'number_of_staff',
		'user_id',
		'observed_id'
	];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function details(): \Illuminate\Database\Eloquent\Relations\HasMany {
		return $this->hasMany(ShadowFormDetail::class);
	}

	public function observer() {
		return $this->belongsTo( User::class, 'user_id' );
	}

	public function observed(): \Illuminate\Database\Eloquent\Relations\BelongsTo {
		return $this->belongsTo( User::class, 'observed_id' );
	}
}
