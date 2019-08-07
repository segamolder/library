<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 06 Aug 2019 20:28:56 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Bookshelf
 * 
 * @property int $id
 * @property int $free_book_places
 * @property int $bookcase
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $bookplaces
 *
 * @package App\Models
 */
class Bookshelf extends Eloquent
{
	protected $casts = [
		'free_book_places' => 'int',
		'bookcase' => 'int'
	];

	protected $fillable = [
		'free_book_places',
		'bookcase'
	];

	public function bookcase()
	{
		return $this->belongsTo(\App\Models\Bookcase::class, 'bookcase');
	}

	public function bookplaces()
	{
		return $this->hasMany(\App\Models\Bookplace::class, 'shelve');
	}
}
