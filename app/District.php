<?php

namespace App;

use Yajra\Auditable\AuditableTrait;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use AuditableTrait;

    protected $fillable = ['name', 'status', 'province_id'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function communes()
    {
    	return $this->hasMany(Commune::class);
    }
}
