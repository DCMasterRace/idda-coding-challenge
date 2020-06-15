<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyAnalytic extends Model
{
    //
    protected $table = "property_analytics";

    protected $fillable = ['property_id', 'analytic_type_id', 'value'];
}
