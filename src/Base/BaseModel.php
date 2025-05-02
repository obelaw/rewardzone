<?php

namespace Obelaw\RewardZone\Base;

use Obelaw\Twist\Base\BaseModel as TwistBaseModel;

abstract class BaseModel extends TwistBaseModel
{
    protected string $postfix = 'rewardzone_';
}
