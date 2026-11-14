<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RationaleDetail extends Model
{
    use HasFactory;
	protected $fillable = [
		'statement',
		'response',
		'rationale_id'
	];

	public function rationale(  ) {
		return $this->belongsTo(Rationale::class, 'rationale_id', 'id');
	}
}
