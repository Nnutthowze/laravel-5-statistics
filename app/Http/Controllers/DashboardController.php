<?php

namespace App\Http\Controllers;

use App\EnviromentalData;
use App\Services\TransformService;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Log;
use Illuminate\Support\MessageBag;

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
        return TransformService::transform($envData);
    }
}
