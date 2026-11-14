<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlacementTask extends Model
{
    use HasFactory;

	protected $fillable = ['student_needs', 'user_id'];

	public function user(  ) {
		return $this->belongsTo(User::class, 'user_id', 'id');
	}

	public function plannings(  ) {
		return $this->hasMany(PlacementTaskPlanning::class, 'placement_task_id', 'id');
	}

	public function differentials(  ) {
		return $this->hasMany(PlacementTaskDifferential::class, 'placement_task_id', 'id');
	}

	public function stems(  ) {
		return $this->hasMany(PlacementTaskStem::class, 'placement_task_id', 'id');
	}
}
