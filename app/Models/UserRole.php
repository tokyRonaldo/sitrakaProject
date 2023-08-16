<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;

      /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [
        'id'
    ];


    public function contact()
    {
        return $this->belongsTo(\App\Models\Contact::class, 'contact_id');
    }

    public function sell_lines()
    {
        return $this->hasMany(\App\Models\TransactionLine::class);
    }

     public function role()
    {
        return $this->belongsTo(\App\Models\Role::class, 'role_id');
    }

    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

}
