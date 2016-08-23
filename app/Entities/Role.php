<?php
namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    protected $fillable = ['group_id', 'user_id', 'is_super'];

    public function groups()
    {
        return $this->belongsTo('App\Entities\Group', 'group_id', 'id');
    }

    public function users()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
