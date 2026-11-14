<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'tagline',
        'email',
        'password',
        'slug',
	    'mentor_id',
	    'link_tutor_id',
	    'institute_id',
	    'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


	/**
	 * return email like a**g@gmail.com
	 */
	public function getPrivatisedEmailAttribute() {
		$email = $this->email;
		$firstChar = $email[0];
		$lastChar = $email[strlen($email) - 1];
		$domain = substr($email, strpos($email, '@') + 1);

		// Create the transformed email pattern
		$transformedEmail = $firstChar . '**' . $lastChar . '@' . $domain;

		return $transformedEmail;
	}

	public function students() {
		return 	$this->hasMany(User::class, 'mentor_id', 'id')->whereHas('roles', function($q) {
			$q->where('name', 'Teaching Student');
		});
	}

	public function linkTutorStudents(  ) {
		return $this->hasMany(User::class, 'link_tutor_id', 'id')->whereHas('roles', function($q) {
			$q->where('name', 'Teaching Student');
		});
	}

	public function mentors() {
		return 	$this->hasMany(User::class, 'link_tutor_id', 'id')->whereHas('roles', function($q) {
			$q->where('name', 'Mentor');
		});
	}

	public function getFullNameAttribute(): string {
		return "{$this->first_name} {$this->last_name}";
	}

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts() {
        return $this->hasMany(Post::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function slides() {
        return $this->hasMany(Slide::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function profileImage()
    {
        return $this->morphOne(Media::class, 'mediable');
    }

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function observations() {
		return $this->hasMany(Observation::class);
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function observationSteps() {
		return $this->hasMany(ObservationStep::class);
	}

	public function reflections(  ) {
		return $this->hasMany(Reflection::class);
	}

	public function institute(  ) {
		return $this->belongsTo(Institute::class);
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function thread( ) {
		return $this->hasMany(Thread::class);
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function replies(  ) {
		return $this->hasMany(Reply::class);
	}

    /**
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
