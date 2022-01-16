<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $guarded = ['_token'];

    public function getTitleAttribute($value)
    {
        return $this->status == 'draft' ? ' Draft / '.$value : $value;
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault([
            'nmae' => 'Noy Found'
        ]);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class,'question_tag','quesstion_id','tag_id');
    }

    public function hasTag($tagid){
        return in_array($tagid,$this->tags->pluck('id')->toArray());
    }

    public function votes()
    {
        return $this->morphMany(Vote::class,'voteable','voteable_type','voteable_id','id');// model , name morph ,
    }

    public function comments()
    {
        return $this->morphMany(Comment::class,'commentable');
    }
}
