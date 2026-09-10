<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class AdminModel extends Authenticatable
{
    use Notifiable;

    protected $table = 'admin';

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
        'remember_token',
    ];

    public function getAuthPassword(): string
    {
        return $this->masterkey;
    }
}
