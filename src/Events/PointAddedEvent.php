<?php

namespace Obelaw\RewardZone\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Obelaw\RewardZone\Models\Point;

class PointAddedEvent
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public Point $point
    ) {
    }
}
