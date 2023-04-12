<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Read extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function contact()
    {
        return $this->hasOne('contacts');
    }

}
