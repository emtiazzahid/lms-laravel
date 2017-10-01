<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $table = 'teachers';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function signature()
    {
        return $this->belongsTo(UserSignature::class, 'user_id', 'user_id');
    }
}
