<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToolModel extends Model
{

use HasFactory;
     protected $table = 'si_tools';

    protected $fillable = [
        'tools_description',
        'tool_class_id',
        'tool_cat_id',
        'size',
        'qty',
        'purchased_at',
        'brand',
        'status',
        'invoice_reference',
        'unit_price',
        'serial_tag',
        'created_at',
        'updated_at',
    ];

    public function tool_category()
    {
        return $this->belongsTo(ToolCategoriesModel::class, 'tool_cat_id');
    }

    public function tool_class()
    {
        return $this->belongsTo(ToolClassificationModel::class, 'tool_class_id');
    }

}
