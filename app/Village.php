<?php

namespace App;

use Yajra\Auditable\AuditableTrait;
use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    use AuditableTrait;

    protected $fillable = [
        'name',
        'commune_id',
        'status'
    ];

    public function commune()
    {
    	return $this->belongsTo(Commune::class);
    }

    public function schools()
    {
    	return $this->hasMany(School::class);
    }
}
