<?php

namespace Obelaw\RewardZone\Models;

use Obelaw\RewardZone\Base\BaseModel;

class Point extends BaseModel
{
    protected $fillable = [
        'profile_id',
        'points',
        'description',
        'type',
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
