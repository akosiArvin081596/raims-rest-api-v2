<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LguUserAssignment extends Model
{
    use HasFactory;

    protected $fillable = ['lgu_id', 'user_id'];

    public function lgu()
    {
        return $this->belongsTo(Lgu::class);
    }

    public function lguUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}