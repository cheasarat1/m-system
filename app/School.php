<?php

namespace App;

use Yajra\Auditable\AuditableTrait;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use AuditableTrait;

    protected $fillable = [
        'level_id',
        'zone_id',
        'province_id',
        'district_id',
        'commune_id',
        'village_id',
        'name',
        'code',
        'status'
    ];

    public function Level()
    {
    	return $this->belongsTo(Level::class);
    }

    public function zone()
    {
    	return $this->belongsTo(Zone::class);
    }

    public function Commune()
    {
    	return $this->belongsTo(Commune::class);
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }
}
