<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 07 Aug 2019 15:50:37 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class CategoryName
 * 
 * @property int $id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class CategoryName extends Eloquent
{
	protected $table = 'category_name';

	protected $fillable = [
		'name'
	];
}
