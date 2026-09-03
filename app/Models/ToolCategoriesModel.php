<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToolCategoriesModel extends Model
{
    use HasFactory;
    //
     protected $table = 'tool_categories';

    protected $fillable = ['tool_category', 'tool_class_id'];

  public function toolsclassification()
    {
        return $this->belongsTo(
            ToolClassificationModel::class,
            'tool_class_id',
            'id'
        );
    }

public function toolclass()
    {
        return $this->hasMany(
            ToolModel::class,
            'tool_cat_id',
            'id'
        );
    }

}
