<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialModel extends Model
{

use HasFactory;

   protected $table = 'materials';

    protected $fillable = [
        'item_description',
        'class_id',
        'category_id',
        'supplier_id',
        'unit',
        'quantity',
        'unit_price',
        'from_date',
        'to_date',
    ];

    // =========================
    // RELATIONSHIPS
    // =========================

    public function classification()
    {
        return $this->belongsTo(ItemClassificationModel::class, 'class_id');
    }

    public function category()
    {
        return $this->belongsTo(ItemCategoryModel::class, 'category_id');
    }

    public function supplier()
    {
        return $this->belongsTo(SupplierModel::class, 'supplier_id');
    }
}
