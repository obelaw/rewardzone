<?php

namespace Obelaw\RewardZone\Management;

use Obelaw\RewardZone\Management\PointsConfig;
use Obelaw\RewardZone\Events\PointAddedEvent;
use Obelaw\RewardZone\Events\PointDeductionEvent;

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
        $creditPoints = $this->profile?->points()
            ->where('expires_at', '>', now())
            ->where('type', 'credit')->sum('points') ?? 0;

        $debitPoints = $this->profile?->points()->where('type', 'debit')->sum('points') ?? 0;
        return $creditPoints - $debitPoints;
    }

    public function addPoint($points, $description = null, $expiresAt = null): int
    {
        $point = $this->profile->points()->create([
            'points' => $points,
            'description' => $description,
            'type' => 'credit',
            'expires_at' => $expiresAt ?? now()->addDays(oconfig('obelaw.rewardzone.expires_at')),
        ]);

        PointAddedEvent::dispatch($point);

        return $this->getPoints();
    }

    public function deductionPoint($points, $description = null): int
    {
        $point = $this->profile->points()->create([
            'points' => $points,
            'description' => $description,
            'type' => 'debit',
        ]);

        PointDeductionEvent::dispatch($point);

        return $this->getPoints();
    }

    public function getBalanceByUnits()
    {
        return $this->pointsConfig->pointsToUnits($this->getPoints());
    }
}
