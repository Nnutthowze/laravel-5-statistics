<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class EnviromentalDataTableSeeder extends Seeder
{
    private $table = 'enviromental_data';
    private $fileNames = array('2012.txt', '2013.txt', '2014.txt', '2015.txt');
    private $pathToFile;
    private $startDate;

    public function __construct()
    {
        $this->pathToFile = base_path() . '/database/rawdata/';
        $this->startDate = Carbon::create(2012, 1, 12, 0);
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table($this->table)->truncate();
        $this->seedFromCSV($this->fileNames, $this->pathToFile, "\t");
    }

    /**
     * @param $fileNames
     * @param $pathToFile
     * @param string $deliminator
     * @return array
     */
    public function seedFromCSV($fileNames, $pathToFile, $deliminator = ',')
    {
        $airTempIndex = 1;
        $barPressIndex = 2;
        $windSpeedIndex = 7;
        $fileNamesLength = count($fileNames);

        for ($i = 0; $i < $fileNamesLength; $i++)
        {
            $dataset = array();
            $csv = $pathToFile . $fileNames[$i];
            if (file_exists($csv))
            {
                $file = fopen($csv, 'r');
                while ($line = fgetcsv($file, 500, $deliminator))
                {
                    $date = substr($line[0], 0, 10);
                    $dataset[$date]['air_temp'][] = ltrim($line[$airTempIndex]);
                    $dataset[$date]['bar_press'][] = ltrim($line[$barPressIndex]);
                    $dataset[$date]['wind_speed'][] = ltrim($line[$windSpeedIndex]);
                }

                fclose($file);

                if ($i === 0)
                {
                    array_shift($dataset);
                }

                $this->insertData($dataset);
            }
            else
            {
                Log::error("File {$csv} doesn't exist!");
            }
        }
    }

    /**
     * @param $seedData
     */
    public function insertData($seedData)
    {
        DB::beginTransaction();
        foreach ($seedData as $date => $seed)
        {
            try
            {
                DB::table($this->table)->insert([
                    'data_recorded' => $this->startDate,
                    'air_temp' => implode(',', $seed['air_temp']),
                    'bar_press' => implode(',', $seed['bar_press']),
                    'wind_speed' => implode(',', $seed['wind_speed']),
                ]);
            }
            catch(PDOException $e)
            {
                Log:error($e->getMessage());
            }
            $this->startDate->addDay();
        }
        DB::commit();
    }
}