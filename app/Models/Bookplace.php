<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 07 Aug 2019 15:50:37 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Bookplace
 * 
 * @property int $id
 * @property bool $is_busy
 * @property bool $is_free
 * @property int $case
 * @property int $shelve
 * @property int $place
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $book_copies
 *
 * @package App\Models
 */
class Bookplace extends Eloquent
{
	protected $casts = [
		'is_busy' => 'bool',
		'is_free' => 'bool',
		'case' => 'int',
		'shelve' => 'int',
		'place' => 'int'
	];

	protected $fillable = [
		'is_busy',
		'is_free',
		'case',
		'shelve',
		'place'
	];

	public function book_copies()
	{
		return $this->hasMany(\App\Models\BookCopy::class, 'place_id');
	}
}
