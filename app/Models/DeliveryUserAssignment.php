<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryUserAssignment extends Model
{
    use HasFactory;

    protected $fillable = ['delivery_user_id', 'assistance_request_item_id'];

    public function deliveryUser()
    {
        return $this->belongsTo(User::class, 'delivery_user_id');
    }

    public function item()
    {
        return $this->belongsTo(AssistanceRequestItem::class, 'assistance_request_item_id');
    }
}