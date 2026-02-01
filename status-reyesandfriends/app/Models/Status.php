<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable = [
        'name',
        'description',
        'color',
    ];

    public function services()
    {
        return $this->hasMany(Service::class, 'status_id');
    }
}