<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
	protected $fillable = ['page_id', 'order', 'section_type_id', 'status'];

	public function sectionable(  ) {
		return $this->morphTo();
	}
}
