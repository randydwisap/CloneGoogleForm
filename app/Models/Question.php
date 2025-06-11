<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['form_id', 'text', 'type', 'is_required', 'order'];
    public function form() { return $this->belongsTo(Form::class); }
    public function options() { return $this->hasMany(QuestionOption::class); }
}
