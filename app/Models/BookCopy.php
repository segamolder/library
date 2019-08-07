<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 06 Aug 2019 20:28:56 +0000.
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
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 *
 * @package App\Models
 */
class BookCopy extends Eloquent
{
	protected $table = 'book_copy';

	protected $casts = [
		'author' => 'int'
	];

	protected $dates = [
		'publishing_year'
	];

	protected $fillable = [
		'author',
		'title',
		'publishing_year'
	];

	public function author()
	{
		return $this->belongsTo(\App\Models\Author::class, 'author');
	}
}
