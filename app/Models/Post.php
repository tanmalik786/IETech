<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'type',
        'category',
	    'user_id',
	    'excerpt'
    ];

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeMine($query) {
        return $query->where('user_id', auth()->id());
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeQualifications($query) {
        return $query->where('type', 'qualifications');
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeExperiences($query) {
        return $query->where('type', 'experiences');
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeAchievements($query) {
        return $query->where('type', 'achievements');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function postMetas() {
        return $this->hasMany(PostMeta::class, 'post_id');
    }

	public function teachingLogs() {
		return $this->hasMany(TeachingLog::class, 'post_id');
	}

	public function slug(  ) {
		return $this->hasOne(PostSlug::class);
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\MorphOne
	 */
	public function featuredImage()
	{
		return $this->morphOne(Media::class, 'mediable');
	}
}
