<?php

namespace App;

use Yajra\Auditable\AuditableTrait;
use Illuminate\Database\Eloquent\Model;

class Commune extends Model
{
    use AuditableTrait;

    protected $fillable = ['name', 'district_id', 'status'];

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function villages()
    {
    	return $this->hasMany(Village::class);
    }

    public function schools()
    {
        return $this->hasMany(School::class);
    }
}
