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

    /**
     * The article author relation.
     *
     * @return mixed
     */
	public function author()
	{
		return $this->belongsTo();
	}

    /**
     * Comments relationship for the article.
     *
     * @return mixed
     */
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
