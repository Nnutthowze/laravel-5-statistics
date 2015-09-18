<?php

namespace App\Http\Controllers;

use App\Datasets\StatisticsDataset;
use App\EnviromentalData;
use App\Services\EnviromentalDataTransformer;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Log;
use Illuminate\Support\MessageBag;
use League\Fractal;

class DashboardController extends Controller
{
    /**
     * Display a dashboard view
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('pages.dashboard');
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return string
     */
    public function show(Request $request)
    {
        $min = EnviromentalData::getFirstDate();
        $max = EnviromentalData::getLastDate();

        $dt = Carbon::createFromFormat('Y-m-d', $max);
        $max = $dt->addDay();

        $this->validate($request, [
            'from' => 'required|date|after:' . $min . '|before:' . $max,
            'to' => 'required|date|after:' . $min . '|before:' . $max
        ]);

        $envData = EnviromentalData::whereBetween('data_recorded', array($request->from, $request->to))->get();
        return EnviromentalDataTransformer::transform($envData);
        //$resource = new Fractal\Resource\Collection($envData, new EnviromentalData);

        /*$resource = new Fractal\Resource\Collection($envData, function(EnviromentalData $env) {
            return [
                'Data Recorded' => $env->data_recorded,
                'Mean Temperature' => (new StatisticsDataset($env->air_temp))->getMean(),
                'Median Temperature' => (new StatisticsDataset($env->air_temp))->getMedian(),
                'Mean Pressure' => (new StatisticsDataset($env->bar_press))->getMean(),
                'Median Pressure' => (new StatisticsDataset($env->bar_press))->getMedian(),
                'Mean Speed' => (new StatisticsDataset($env->wind_speed))->getMean(),
                'Median Speed' => (new StatisticsDataset($env->wind_speed))->getMedian()
            ];
        });*/

        //dd($resource);
    }
}
