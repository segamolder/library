<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 07 Aug 2019 15:50:37 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class AuthorController
 *
 * @property int $id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @property \Illuminate\Database\Eloquent\Collection $book_copies
 *
 * @package App\Models
 */
class Author extends Eloquent
{
	protected $table = 'author';

	protected $fillable = [
		'name'
	];

	public function book_copies()
	{
		return $this->hasMany(\App\Models\BookCopy::class, 'author');
	}
}
