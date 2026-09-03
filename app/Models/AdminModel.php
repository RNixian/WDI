<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class AdminModel extends Authenticatable
{
    use Notifiable;

    protected $table = 'admin'; // make sure this is correct

    protected $fillable = [
        'firstname',
        'middlename',
        'lastname',
        'username',
        'masterkey',
        'role',
        'status',
    ];

    protected $hidden = [
        'masterkey',
    ];

    // IMPORTANT: tell Laravel what password field to use
    public function getAuthPassword()
    {
        return $this->masterkey;
    }
}
