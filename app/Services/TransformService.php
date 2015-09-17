<?php

namespace App\Services;

use App\Datasets\StatisticsDataset;
use League\Fractal;

class TransformService
{
    public static function transform($bigData)
    {
        $airStats = array();
        $barStats = array();
        $windStats = array();

        foreach ($bigData as $row)
        {
            $airStats = array_merge($airStats, $row->air_temp);
            $barStats = array_merge($barStats, $row->bar_press);
            $windStats = array_merge($windStats, $row->wind_speed);
        }

        $airAvg = new StatisticsDataset($airStats);
        $barAvg = new StatisticsDataset($barStats);
        $windAvg = new StatisticsDataset($windStats);

        $result = array(
            'air_temp' => array(
                'mean'      => $airAvg->getMean(),
                'median'    => $airAvg->getMedian()
            ),
            'bar_press' => array(
                'mean'      => $barAvg->getMean(),
                'median'    => $barAvg->getMedian()
            ),
            'wind_speed' => array(
                'mean'      => $windAvg->getMean(),
                'median'    => $windAvg->getMedian()
            )
        );

        return $result;
    }
}