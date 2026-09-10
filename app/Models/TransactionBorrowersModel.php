<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionBorrowersModel extends Model
{
    use HasFactory;

    protected $table = 'transaction_borrowers';

    protected $fillable = [
        'transaction_id',
        'borrower_id',
        'role',
        'confirmation_method',
        'confirmation_status',
        'confirmed_at',
    ];

    public function borrower()
    {
        return $this->belongsTo(
            BorrowersModel::class,
            'borrower_id',
            'id'
        );
    }

    public function transaction()
    {
        return $this->belongsTo(
            ToolTransactionModel::class,
            'transaction_id',
            'id'
        );
    }
}
