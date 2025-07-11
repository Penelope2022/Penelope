<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plugin extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'version',
        'path',
        'enabled',
    ];
}
