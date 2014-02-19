<?php


class ForumUser extends Eloquent {
	protected $key = "id";
	protected $table = "forum_users";
	public $timestamps = false;
	protected $guarded = array();

	public function user() {
		return $this->belongsTo('User', 'id');
	}
}