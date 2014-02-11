<?php

class Role extends Eloquent {

    protected $key = 'id';
    protected $table = 'role';

    public function users()
    {
        return $this->belongsToMany('User');
    }

}