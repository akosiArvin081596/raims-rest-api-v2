<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssistanceRequestItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'assistance_request_id',
        'item_name',
        'quantity',
        'status',
        'delivery_date',
    ];

    public function request()
    {
        return $this->belongsTo(AssistanceRequest::class);
    }

    public function deliveryAssignment()
    {
        return $this->hasOne(DeliveryUserAssignment::class, 'assistance_request_item_id');
    }
}