<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'make', 'model', 'year', 'user_id',
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'created_at' => 'datetime',
		'updated_at' => 'datetime'
	];

	protected static function boot()
	{
		parent::boot();

		// auto-set value to the currently authenticated user
		static::creating(function ($query) {
			$query->user_id = $query->user_id ?? auth()->user()->id;
		});
	}


	public function user()
	{
		return $this->belongsTo('App\User');
	}
}
