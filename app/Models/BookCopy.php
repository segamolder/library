<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 07 Aug 2019 15:50:37 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class BookCopy
 * 
 * @property int $id
 * @property int $author
 * @property string $title
 * @property \Carbon\Carbon $publishing_year
 * @property int $place_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Bookplace $bookplace
 *
 * @package App\Models
 */
class BookCopy extends Eloquent
{
	protected $table = 'book_copy';

	protected $casts = [
		'author' => 'int',
		'place_id' => 'int'
	];

	protected $dates = [
		'publishing_year'
	];

	protected $fillable = [
		'author',
		'title',
		'publishing_year',
		'place_id'
	];

	public function author()
	{
		return $this->belongsTo(\App\Models\Author::class, 'author');
	}

	public function bookplace()
	{
		return $this->belongsTo(\App\Models\Bookplace::class, 'place_id');
	}
}
