<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionLine extends Model
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

    public function transaction()
    {
        return $this->belongsTo(\App\Models\Transaction::class);
    }

    public function produit()
    {
        return $this->belongsTo(\App\Models\Article::class, 'article_id');
    }
}
