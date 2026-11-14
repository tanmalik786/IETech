<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObservationRemark extends Model
{
    use HasFactory;

	protected $fillable = ['remarks'];

	public function observation() {
		return $this->belongsTo(Observation::class);
	}
}
