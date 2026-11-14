<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlacementTaskDifferential extends Model
{
    use HasFactory;

	protected $fillable = ['strategy', 'comments'];

	public function placementTask(  ) {
		return $this->belongsTo(PlacementTask::class, 'placement_task_id', 'id');
	}
}
