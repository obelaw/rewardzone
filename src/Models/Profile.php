<?php

namespace Obelaw\RewardZone\Models;

use Illuminate\Database\Eloquent\Relations\MorphTo;
use Obelaw\RewardZone\Base\BaseModel;

class Profile extends BaseModel
{
    public function profileable(): MorphTo{
        return $this->morphTo();   
    }

    public function points(){
        return $this->hasMany(Point::class);
    }
}
