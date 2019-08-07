<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 06 Aug 2019 20:28:56 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Bookplace
 * 
 * @property int $id
 * @property bool $is_busy
 * @property bool $is_free
 * @property int $shelve
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Bookshelf $bookshelf
 *
 * @package App\Models
 */
class Bookplace extends Eloquent
{
	protected $casts = [
		'is_busy' => 'bool',
		'is_free' => 'bool',
		'shelve' => 'int'
	];

	protected $fillable = [
		'is_busy',
		'is_free',
		'shelve'
	];

	public function bookshelf()
	{
		return $this->belongsTo(\App\Models\Bookshelf::class, 'shelve');
	}
}
