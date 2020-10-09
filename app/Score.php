<?php

namespace App;

use Yajra\Auditable\AuditableTrait;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use AuditableTrait;

    protected $fillable = ['evaluation_id', 'question_id', 'score1', 'score2', 'score3', 'total', 'reason', 'solution', 'status'];

    public function evaluation()
    {
    	return $this->belongsTo(Evaluation::class);
    }

    public function question()
    {
    	return $this->belongsTo(Question::class);
    }
}
