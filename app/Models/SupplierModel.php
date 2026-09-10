<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierModel extends Model
{
    use HasFactory;

    protected $table = 'suppliers';

    protected $fillable = [
        'supplier',
    ];

    public function tools()
    {
        return $this->hasMany(
            ToolModel::class,
            'supplier_id',
            'id'
        );
    }
}
