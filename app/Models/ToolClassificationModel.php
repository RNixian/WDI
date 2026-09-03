<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToolClassificationModel extends Model
{
    use HasFactory;

     protected $table = 'tool_classification';

    protected $fillable = ['tool_class'];

public function toolcategories()
    {
        return $this->hasMany(
            ToolCategoriesModel::class,
            'tool_class_id',
            'id'
        );
    }

public function toolclass()
    {
        return $this->hasMany(
            ToolModel::class,
            'tool_class_id',
            'id'
        );
    }


}
