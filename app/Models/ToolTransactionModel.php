<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToolTransactionModel extends Model
{
    use HasFactory;

    protected $table = 'tool_transactions';

    protected $fillable = [
        'transaction_code',
        'transaction_type',
        'status',
    ];

    public function borrowers()
    {
        return $this->hasMany(
            TransactionBorrowersModel::class,
            'transaction_id',
            'id'
        );
    }

    public function items()
    {
        return $this->hasMany(
            TransactionToolItemsModel::class,
            'transaction_id',
            'id'
        );
    }
}
