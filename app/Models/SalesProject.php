<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalesProject extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'sales_projects';
    protected $fillable = [
        'id_project',
        'id_sales'
    ];

    public function project(){
        return $this->belongsTo(ProjectV2::class, 'id_project');
    }

    public function sales(){
        return $this->belongsTo(Sales::class, 'id_sales');
    }
}
