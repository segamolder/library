<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 09 Aug 2019 21:00:27 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Student
 * 
 * @property int $id
 * @property string $name
 * @property string $surname
 * @property string $lastname
 * @property string $student_class
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $user_id
 * 
 * @property \App\Models\User $user
 * @property \Illuminate\Database\Eloquent\Collection $issued_books
 *
 * @package App\Models
 */
class Student extends Eloquent
{
	protected $casts = [
		'user_id' => 'int'
	];

	protected $fillable = [
		'name',
		'surname',
		'lastname',
		'student_class',
		'user_id'
	];

	public function user()
	{
		return $this->belongsTo(\App\Models\User::class);
	}

	public function issued_books()
	{
		return $this->hasMany(\App\Models\IssuedBook::class);
	}
}
