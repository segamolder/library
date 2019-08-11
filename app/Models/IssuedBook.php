<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 10 Aug 2019 17:25:09 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IssuedBook
 * 
 * @property int $id
 * @property int $student_id
 * @property int $book_id
 * @property bool $is_returned
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property bool $is_requested
 * @property bool $on_hands
 * 
 * @property \App\Models\BookCopy $book_copy
 * @property \App\Models\Student $student
 *
 * @package App\Models
 */
class IssuedBook extends Eloquent
{
	protected $casts = [
		'student_id' => 'int',
		'book_id' => 'int',
		'is_returned' => 'bool',
		'is_requested' => 'bool',
		'on_hands' => 'bool'
	];

	protected $fillable = [
		'student_id',
		'book_id',
		'is_returned',
		'is_requested',
		'on_hands'
	];

	public function book_copy()
	{
		return $this->belongsTo(\App\Models\BookCopy::class, 'book_id');
	}

	public function student()
	{
		return $this->belongsTo(\App\Models\Student::class);
	}
}
