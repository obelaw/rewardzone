<?php

namespace Obelaw\RewardZone\Traits;

use Obelaw\RewardZone\Models\Profile;

trait HasProfile
{
    public function profile()
    {
        return $this->morphOne(Profile::class, 'profileable');
    }
}
