<?php defined('BASEPATH') or exit('No direct script access allowed');

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Manifest extends Model
{
	/**
	 * The database table name.
	 *
	 * @var string
	 */
	protected $table = 'events';

	/**
	 * Mass-assign fields for the database.
	 *
	 * @var array
	 */
	protected $fillable = [];

	/**
	 * Country data relation.
	 *
	 * @return belongsTo instance.
	 */
	public function country()
	{
		return $this->belongsTo();
	}

	/**
	 * City data relation.
	 *
	 * @return belongsTo instance.
	 */
	public function city()
	{
		return $this->belongsTo();
	}
}
