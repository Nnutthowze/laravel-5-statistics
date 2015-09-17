<?php

namespace App\Http\Controllers;

use App\EnviromentalData;
use App\Services\TransformService;
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

        $this->validate($request, [
            'from' => 'required|min:' . $min,
            'to' => 'required|max:' . $max
        ]);

        try {
            $envData = EnviromentalData::whereBetween('data_recorded', array($request->from, $request->to))->get();
            return TransformService::transform($envData);
        }
        catch(\Exception $e)
        {
            Log::error($e->getMessage());
            return redirect()->back();
            //return response()->json($e->getMessage(), 422);
        }
    }
}
