<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketMsg extends Model
{
    use HasFactory;

    protected $table = 'tickets_msg';
    protected $fillable = [
        'senderId',
        'text',
        'ticketId',
    ];
}
