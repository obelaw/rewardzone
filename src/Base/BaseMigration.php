<?php

namespace Obelaw\RewardZone\Base;

use Obelaw\Twist\Base\BaseMigration as TwistBaseMigration;

abstract class BaseMigration extends TwistBaseMigration
{
    protected string $postfix = 'rewardzone_';
}
