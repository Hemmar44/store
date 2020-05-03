<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function bought()
    {
        return $this->hasMany('App\Bought');
    }
}
