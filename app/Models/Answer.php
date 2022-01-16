<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $guarded=['_token'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function votes()
    {
        return $this->morphMany(Vote::class,'voteable','voteable_type','voteable_id','id');// model , name morph , coluems
    }

    public function comments()
    {
        return $this->morphMany(Comment::class,'commentable');
    }
}
