<?php

namespace App;

use Yajra\Auditable\AuditableTrait;
use Illuminate\Database\Eloquent\Model;

class Effective extends Model
{
    use AuditableTrait;

    protected $fillable = ['question_id', 'status'];
}
