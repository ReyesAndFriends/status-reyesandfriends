<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceCheck extends Model
{
    protected $fillable = [
        'service_id',
        'checked_at',
        'response_time',
        'http_code',
        'status',
        'error_message',
    ];
}
