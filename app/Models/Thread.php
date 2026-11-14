<?php

	namespace App\Models;

	use Illuminate\Database\Eloquent\Factories\HasFactory;
	use Illuminate\Database\Eloquent\Model;
	use Illuminate\Support\Str;

	class Thread extends Model {

		use HasFactory;

		protected $fillable = [
			'topic_id',
			'slug',
			'title',
			'content',
			'tags',
			'user_id',
			'status',
		];

		/**
		 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
		 */
		public function topic() {
			return $this->belongsTo( Topic::class );
		}

		/**
		 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
		 */
		public function user() {
			return $this->belongsTo( User::class );
		}

		/**
		 * @return \Illuminate\Database\Eloquent\Relations\HasMany
		 */
		public function replies() {
			return $this->hasMany( Reply::class );
		}

		/**
		 * @param $value
		 */
		public function setSlugAttribute( $value ) {
			$this->attributes['slug'] = Str::slug($value);
		}

		/**
		 * @return string
		 */
		public function getRouteKeyName()
		{
			return 'slug';
		}
	}
