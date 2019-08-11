<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 07 Aug 2019 15:50:37 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Category
 * 
 * @property int $id
 * @property int $book_id
 * @property int $category_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class Category extends Eloquent
{
	protected $table = 'category';

	protected $casts = [
		'book_id' => 'int',
		'category_id' => 'int'
	];

	protected $fillable = [
		'book_id',
		'category_id'
	];
}
