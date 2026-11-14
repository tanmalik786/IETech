<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityQuestion extends Model
{
    use HasFactory;

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function observationStep() {
		return $this->belongsTo(ActivityQuestion::class);
	}
}
