<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class BorrowersBioModel extends Model
{
      use HasFactory;
 protected $table = 'borrower_biometrics';
 protected $fillable = [
    'borrower_id',
    'sensor_id',
    'fingerprint_slot',
    'enrolled_at',
    'finger_name',
    'status',
    'revoked_at',


 ];

  public function borrowersprofile()
    {
        return $this->belongsTo(
            BorrowersModel::class,
            'borrower_id',
            'id'
        );
    }



}
