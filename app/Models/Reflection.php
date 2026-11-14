<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reflection extends Model
{
	protected $fillable = ['title', 'slug', 'link', 'comments', 'user_id'];
    use HasFactory;

	public function user() {
		return $this->belongsTo(User::class);
	}
}
