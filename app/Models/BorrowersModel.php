<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorrowersModel extends Model
{
     use HasFactory;
 protected $table = 'borrowers';
 protected $fillable = [
    'firstn',
    'lastn',
    'contact_number',
 ];


public function transactions()
    {
        return $this->hasMany(TransactionModel::class, 'withdrawn_by');
    }
}
