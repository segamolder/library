<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 06 Aug 2019 20:28:56 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Bookcase
 * 
 * @property int $id
 * @property int $free_shelves
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $bookshelves
 *
 * @package App\Models
 */
class Bookcase extends Eloquent
{
	protected $casts = [
		'free_shelves' => 'int'
	];

	protected $fillable = [
		'free_shelves'
	];

	public function bookshelves()
	{
		return $this->hasMany(\App\Models\Bookshelf::class, 'bookcase');
	}
}
