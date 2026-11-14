<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlacementTaskStem extends Model
{
    use HasFactory;
	protected $fillable = ['key_skill', 'plan'];

	public function placementTask(  ) {
		return $this->belongsTo(PlacementTask::class, 'placement_task_id', 'id');
	}
}
