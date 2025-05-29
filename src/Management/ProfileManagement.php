<?php

namespace Obelaw\RewardZone\Management;

use Obelaw\RewardZone\Management\PointsConfig;

class ProfileManagement
{
    public $profile;

    public function __construct(
        public $profileable,
        public PointsConfig $pointsConfig,
    ) {
        if (!$this->profile = $this->profileable->profile) {
            $this->profile = $this->profileable->profile()->create();
        }
    }

    public function getPoints()
    {
        $creditPoints = $this->profile?->points()->where('type', 'credit')->sum('points') ?? 0;
        $debitPoints = $this->profile?->points()->where('type', 'debit')->sum('points') ?? 0;
        return $creditPoints - $debitPoints;
    }

    public function addPoint($points, $description = null): int
    {
        $this->profile->points()->create([
            'points' => $points,
            'description' => $description,
        ]);

        return $this->getPoints();
    }

    public function deductionPint($points, $description = null): int
    {
        throw_if($this->getPoints() < $points, 'Insufficient points for deduction.');

        $this->profile->points()->create([
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
