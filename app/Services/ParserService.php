<?php

namespace App\Services;

use Log;
/**
 * Class ParserService
 * @package App\Services
 * Service for parsing the data
 */
class ParserService
{
    /**
     * Parse data from external server
     */
    public function parse()
    {
        $years = array('2012', '2013', '2014', '2015');
        foreach($years as $year)
        {
            $url = "http://lpo.dt.navy.mil/data/DM/Environmental_Data_Deep_Moor_{$year}.txt";
            $fp = fopen(base_path() . "/database/rawdata/{$year}.txt", 'w');

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL             => $url,
                CURLOPT_RETURNTRANSFER  => 1,
                CURLOPT_FILE            => $fp,
                CURLOPT_VERBOSE         => 1,
                CURLOPT_FAILONERROR     => 1
            ));

            curl_exec($curl);

            if (!curl_errno($curl))
            {
                $info = curl_getinfo($curl);
                Log::info("File created  {$year}.txt");
                Log::notice("Evaluation of this script was {$info['total_time']} seconds!");
            }
            else
            {
                Log::error("cURL ERROR " . curl_error($curl));
            }

            curl_close($curl);
            fclose($fp);
        }
    }
}