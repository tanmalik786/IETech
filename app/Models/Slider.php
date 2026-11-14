<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;
	protected $fillable = [
		'name',
		'type'
	];

	public function sections() {
		return $this->morphOne(Section::class, 'sectionable');
	}

	public function slides() {
		return $this->hasMany(Slide::class);
	}
}
