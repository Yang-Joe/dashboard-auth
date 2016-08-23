<?php
namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'groups';
    protected $fillable = ['name'];

    public function role()
    {
        return $this->hasMany('App\Entities\Role');
    }
}
