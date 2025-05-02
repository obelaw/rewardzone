<?php

namespace Obelaw\RewardZone\Management;

use Obelaw\RewardZone\Management\PointsConfig;

class ProfileManagement
{
    public function __construct(
        public $profileable,
        public PointsConfig $pointsConfig,
    ) {
        // Constructor logic here
    }

    public function getPoints()
    {
        $creditPoints = $this->profileable->profile?->points()->where('type', 'credit')->sum('points') ?? 0;
        $debitPoints = $this->profileable->profile?->points()->where('type', 'debit')->sum('points') ?? 0;
        return $creditPoints - $debitPoints;
    }

    public function addPoint($points, $description = null): int
    {
        $this->profileable->profile->points()->create([
            'points' => $points,
            'description' => $description,
        ]);

        return $this->getPoints();
    }

    public function deductionPint($points, $description = null): int
    {
        throw_if($this->getPoints() < $points, 'Insufficient points for deduction.');

        $this->profileable->profile->points()->create([
            'points' => $points,
            'description' => $description,
            'type' => 'debit',
        ]);

        return $this->getPoints();
    }

    public function getBalanceByUnits()
    {
        return $this->pointsConfig->pointsToUnits($this->getPoints());
    }
}
