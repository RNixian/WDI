<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionItemsModel extends Model
{
      use HasFactory;

protected $table = 'transaction_items';

    protected $fillable = [
        'transaction_id',
        'purpose',
        'location',
        'withdrawn_by',
        'released_by',
    ];


public function supplier()
    {
        return $this->belongsTo(WithdrawlTeamModel::class, 'withdrawn_by');
    }

}
