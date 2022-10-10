<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StatusResponse extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'status_responses';
    protected $fillable = [
        'status_response'
    ];
}
