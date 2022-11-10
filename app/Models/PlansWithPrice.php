<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlansWithPrice extends Model
{
    protected $table = 'plans_with_price'; 

    public function planDet()
    {
        return $this->belongsTo(PlansAndPricing::class, 'plan_id', 'id', '=');
    }
    public function currencyDet()
    {
        return $this->belongsTo(Currency::class, 'currency_id', 'id', '=');
    }
}
