<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EscrowTransactions extends Model
{
    public $fillable = ['sender_email', 'sender_phone', 'recipient_email', 'recipient_phone', 'payload'];
}
