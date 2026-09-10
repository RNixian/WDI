<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionToolItemsModel extends Model
{
    use HasFactory;

    protected $table = 'transaction_tool_items';

    protected $fillable = [
        'transaction_id',
        'tool_transactions',
        'tool_id',
        'assigned_to',
        'quantity',
        'status',
        'borrowed_at',
        'returned_at',
    ];

    public function transaction()
    {
        return $this->belongsTo(
            ToolTransactionModel::class,
            'transaction_id',
            'id'
        );
    }

    public function tool()
    {
        return $this->belongsTo(
            ToolModel::class,
            'tool_id',
            'id'
        );
    }

    public function assignedBorrower()
    {
        return $this->belongsTo(
            BorrowersModel::class,
            'assigned_to',
            'id'
        );
    }

}
