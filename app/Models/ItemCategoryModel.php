<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemCategoryModel extends Model
{
    use HasFactory;
    //
     protected $table = 'item_categories';

    protected $fillable = ['item_category'];

public function materials()
    {
        return $this->hasMany(MaterialModel::class, 'category_id');
    }

}

