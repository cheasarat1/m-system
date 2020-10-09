<?php

namespace App;

use Yajra\Auditable\AuditableTrait;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use AuditableTrait;

    protected $fillable = ['name', 'status'];

    public function users()
    {
    	return $this->hasMany(User::class);
    }

    public function districts()
    {
    	return $this->hasMany(District::class);
    }
}
