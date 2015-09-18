<?php

namespace App\Services;

use App\Datasets\StatisticsDataset;
use App\EnviromentalData;
use League\Fractal;

class EnviromentalDataTransformer extends Fractal\TransformerAbstract
{
    public static function transform($bigData)
    {
        $averages = [];

        foreach ($bigData as $row)
        {
            $avgTemp = new StatisticsDataset($row->air_temp);
            $avgBar = new StatisticsDataset($row->bar_press);
            $avgWind = new StatisticsDataset($row->wind_speed);

            $averages[] = [
                'Data Recorded' => $row->data_recorded,
                'Mean Temperature' => $avgTemp->getMean(),
                'Median Temperature' => $avgTemp->getMedian(),
                'Mean Pressure' => $avgBar->getMean(),
                'Median Pressure' => $avgBar->getMedian(),
                'Mean Speed' => $avgWind->getMean(),
                'Median Speed' => $avgWind->getMedian()
            ];
        }

        return $averages;

        /*return [
            'Data Recorded' => $env->data_recorded,
            'Mean Temperature' => (new StatisticsDataset($env->air_temp))->getMean(),
            'Median Temperature' => (new StatisticsDataset($env->air_temp))->getMedian(),
            'Mean Pressure' => (new StatisticsDataset($env->bar_press))->getMean(),
            'Median Pressure' => (new StatisticsDataset($env->bar_press))->getMedian(),
            'Mean Speed' => (new StatisticsDataset($env->wind_speed))->getMean(),
            'Median Speed' => (new StatisticsDataset($env->wind_speed))->getMedian()
        ];*/
    }
}