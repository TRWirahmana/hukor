<?php

class AppConfig extends Eloquent {
	protected $primaryKey = "config_key";
	protected $table = "config";
	public $timestamps = false;
}