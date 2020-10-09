<?php

namespace App;

use Yajra\Auditable\AuditableTrait;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use AuditableTrait;

    protected $fillable = ['question_id', 'name', 'order', 'status'];

    public function questions()
    {
    	return $this->hasMany(Question::class);
    }

    public function childrenQuestions()
    {
    	return $this->hasMany(Question::class)->with('questions');
    }

    public function scores()
    {
    	return $this->hasMany(Score::class);
    }
}
