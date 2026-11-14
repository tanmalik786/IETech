<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Topic extends Model
{
    use HasFactory;
	protected $fillable = [
		'title',
		'subtitle',
		'slug',
		'description',
		'status',
		'parent_id',
		'created_at',
		'updated_at'
	];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function childTopics() {
		return $this->hasMany(Topic::class, 'parent_id', 'id');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function threads() {
		return $this->hasMany(Thread::class);
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function parent() {
		return $this->belongsTo(Topic::class, 'parent_id', 'id');
	}

	/**
	 * @param $value
	 */
	public function setSlugAttribute( $value ) {
		$this->attributes['slug'] = Str::slug($value);
	}

	/**
	 * @param $query
	 *
	 * @return mixed
	 */
	public function scopeParent( $query ) {
		return $query->whereNull('parent_id');
	}
	/**
	 * @param $query
	 *
	 * @return mixed
	 */
	public function scopeActive( $query ) {
		return $query->whereNotIn('status', [0]);
	}

	/**
	 * @return string
	 */
	public function getFormattedStatusAttribute() {
		$status = '';
		switch ($this->attributes['status']) {
			case 0:
				$status = '<span class="badge-danger badge">Deleted</span>';
				break;
			case 1:
				$status = '<span class="badge-success badge">Active</span>';
				break;

		}

		return $status;
	}

	/**
	 * @return string
	 */
	public function getRouteKeyName()
	{
		return 'slug';
	}
}
