<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActionPlan extends Model
{
    use HasFactory;

	protected $fillable = [
		'date',
		'date_description',
		'ps',
		'review',
		'actions',
		'development_point',
		'rating',
		'created_by',
		'user_id'
	];

	public function owner(  ) {
		return $this->belongsTo( User::class, 'user_id', 'id' );
	}

	public function author(  ) {
		return $this->belongsTo(User::class, 'created_by', 'id');
	}

	/**
	 * @return string
	 */
	public function getFormattedRatingAttribute(  ): string {
		return '<span title="' . ucfirst( $this->attributes['rating'] ) . '" class="box box-' . $this->attributes['rating'] . '"></span>';
	}
	
	protected $dates = [
		'date', 'created_at', 'updated_at'
	];
}
