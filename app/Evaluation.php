<?php

namespace App;

use Yajra\Auditable\AuditableTrait;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use AuditableTrait;

    protected $fillable = ['school_id', 'date', 'total', 'status'];

    public function school()
    {
    	return $this->belongsTo(School::class);
    }

    public function scores()
    {
    	return $this->hasMany(Score::class);
    }
}
