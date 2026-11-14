<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeachingLog extends Model
{
    use HasFactory;

	protected $fillable = [
		'week_beginning',
		'description',
		'hours_of_contact_time'
	];

	public function post() {
		return $this->belongsTo(Post::class);
	}

	public function getWeekBeginningAttribute() {
		return Carbon::createFromFormat('d/m/Y', $this->attributes['week_beginning'])->format('d/m/Y');
	}
}
