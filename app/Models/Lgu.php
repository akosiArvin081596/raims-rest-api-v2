<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lgu extends Model
{
    use HasFactory;

    protected $fillable = ['lgu_name', 'province'];

    public function socialWorkerAssignments()
    {
        return $this->hasMany(SocialWorkerAssignment::class);
    }

    public function lguUserAssignments()
    {
        return $this->hasMany(LguUserAssignment::class);
    }
}
