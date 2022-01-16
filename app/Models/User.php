<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Add Socre for user to get badges
    public function addScore($user,$score)
    {
        $user->profile->update([
            'score' => $score
        ]);
        return $user->Addbadges($user);
    }

    public function Addbadges($user)
    {
        $score = $user->profile->score;
        $badges = Badge::where('score','<=',$score)->get();

        if (!is_null($badges)) {
            $user->badges()->attach($badges);
        }
    }

    public function profile()
    {
        return $this->hasOne(Profile::class)->withDefault([
            '*' => 'Not Found'
        ]);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function badges()
    {
        return $this->belongsToMany(Badge::class,'user_badge');
    }
}
