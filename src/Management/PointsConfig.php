<?php

namespace Obelaw\RewardZone\Management;

class PointsConfig
{
    public function __construct(
        private $givePoints = null,
        private $redeemPoints = null,
    ) {
        $this->givePoints = $givePoints;
        $this->redeemPoints = $redeemPoints;
    }

    public function give($units, $points): PointsConfig
    {
        $this->givePoints = $units * $points;

        return $this;
    }

    public function redeem($points, $units): PointsConfig
    {
        $this->redeemPoints = $points * $units;

        return $this;
    }
    public function getGivePoints(): float|int
    {
        return $this->givePoints ?? oconfig('obelaw.rewardzone.give_points', 1);
    }

    public function getRedeemPoints(): float|int
    {
        return $this->redeemPoints ?? oconfig('obelaw.rewardzone.redeem_points', 1);
    }

    public function unitsToPoints($units): float|int
    {
        return $units * $this->getGivePoints();
    }

    public function pointsToUnits($points): float|int
    {
        return $points / $this->getRedeemPoints();
    }
}
