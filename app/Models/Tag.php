<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $guarded = ['_token'];

    public function questions()
    {
        return $this->belongsToMany(Question::class,'question_tag','tag_id','quesstion_id');
    }
}
