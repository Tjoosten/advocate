<?php defined('BASEPATH') or exit('No direct script access allowed');

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Articles extends Model
{
	use SoftDeletes;

	/**
	 * The database table.
	 *
	 * @var string
	 */
	protected $table = '';

	/**
	 * Mass-assign fields for the database table.
	 *
	 * @var array
	 */
	protected $fillable = [];

	public function author()
	{
		return $this->belongsTo();
	}

	public function comments()
	{
		return $this->belongsToMany()
			->withTimestamps();
	}

	/**
	 * Month data relation.
	 *
	 * @return belongsTo instance.
	 */
	public function month()
	{
		return $this->belongsTo();
	}
}
