<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorrowersModel extends Model
{
    use HasFactory;

    protected $table = 'borrowers';

    protected $fillable = [
        'firstname',
        'lastname',
        'emp_id',
        'contact_no',
    ];

    public function transactionBorrowers()
    {
        return $this->hasMany(
            TransactionBorrowersModel::class,
            'borrower_id',
            'id'
        );
    }

    public function borrowersBio()
    {
        return $this->hasMany(
            BorrowersBioModel::class,
            'borrower_id',
            'id'
        );
    }

     public function borrower()
    {
        return $this->hasMany(
            TransactionToolItemsModel::class,
            'borrower_id',
            'id'
        );
    }
}
