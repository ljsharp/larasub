<?php

namespace Ljsharp\LaraSub\Tests\Models;

use Illuminate\Database\Eloquent\Model;
use Ljsharp\LaraSub\Traits\HasSubscriptions;

class User extends Model
{
    use HasSubscriptions;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];
}
