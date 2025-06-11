<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $fillable = ['form_id'];
public function form() { return $this->belongsTo(Form::class); }
public function answers() { return $this->hasMany(Answer::class); }
}
