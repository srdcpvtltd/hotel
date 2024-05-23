<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
}
