<?php

namespace App;

use Yajra\Auditable\AuditableTrait;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use AuditableTrait;

    protected $fillable = ['name', 'description', 'status'];

    public function schools()
    {
    	return $this->hasMany(School::class);
    }
}
