<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saldo extends Model
{
    use HasFactory;

    protected $fillable = [
        'estoque_type', 'valor', 'empresa_id', 'estoque_id', 'user_id', 'status_id'
    ];
}
