<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierModel extends Model
{
    use HasFactory;
    protected $table = 'supliers';
    protected $fillable = ['supplier'];

public function materials()
    {
        return $this->hasMany(MaterialModel::class, 'supplier_id');
    }
}
