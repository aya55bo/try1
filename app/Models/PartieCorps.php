<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartieCorps extends Model
{
    use HasFactory;

    protected $table = 'partie_corps';

    protected $fillable = ['nom', 'image', 'son'];
}
