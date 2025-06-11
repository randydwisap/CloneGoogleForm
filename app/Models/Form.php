<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Form extends Model
{
    protected $fillable = ['user_id', 'title', 'slug', 'description'];
    protected static function boot() {
        parent::boot();
        static::creating(function ($form) {
            if (auth()->check()) {
                $form->user_id = auth()->id();
            }
            $form->slug = Str::slug($form->title) . '-' . uniqid();
        });
    }

    public function user() { return $this->belongsTo(User::class); }
    public function questions() { return $this->hasMany(Question::class)->orderBy('order'); }
    public function submissions() { return $this->hasMany(Submission::class); }
}
