<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
	protected $fillable = ['name', 'type'];

	public function sections() {
		return $this->morphOne(Section::class, 'sectionable');
	}
}
