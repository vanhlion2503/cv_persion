<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Resume extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'start_year', 'end_year', 'description','user_id'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
