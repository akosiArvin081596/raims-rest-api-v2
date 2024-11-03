<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssistanceRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'dromic_report_path',
        'letter_of_request_path',
    ];

    // Define the relationship with AssistanceRequestItem
    public function items()
    {
        return $this->hasMany(AssistanceRequestItem::class);
    }
}