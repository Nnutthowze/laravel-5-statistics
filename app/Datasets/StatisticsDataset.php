<?php

namespace App\Datasets;

class StatisticsDataset
{
    private $values;
    private $valuesLength;
    private $precision = 2;

    public function __construct(array $vals)
    {
        $this->values = $vals;
        sort($this->values);

        $this->valuesLength = count($vals);
    }

    public function getMedian()
    {
        $middle = floor($this->valuesLength / 2);

        if ($this->valuesLength % 2)
        {
            $median = (float)$this->values[$middle];
        }
        else
        {
            $median = round(($this->values[$middle - 1] + $this->values[$middle]) / 2, $this->precision);
        }

        return $median;
    }

    public function getMean()
    {
        $mean = round(array_sum($this->values) / $this->valuesLength, $this->precision);
        return $mean;
    }
}