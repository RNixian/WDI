<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemClassificationModel extends Model
{
        use HasFactory;
     protected $table = 'item_classification';
    protected $fillable = ['item_class'];

public function materials()
    {
        return $this->hasMany(MaterialModel::class, 'class_id');
    }

}
