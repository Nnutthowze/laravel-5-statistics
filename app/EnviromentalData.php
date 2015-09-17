<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnviromentalData extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'enviromental_data';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['data_recorded', 'air_temp', 'bar_press', 'wind_speed'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * The Accessor for 'air_temp' attribute
     *
     * @param $value
     * @return array
     */
    public function getAirTempAttribute($value)
    {
        return explode(',', $value);
    }

    /**
     * The Accessor for 'bar_press' attribute
     *
     * @param $value
     * @return array
     */
    public function getBarPressAttribute($value)
    {
        return explode(',', $value);
    }

    /**
     * The Accessor for 'wind_speed' attribute
     *
     * @param $value
     * @return array
     */
    public function getWindSpeedAttribute($value)
    {
        return explode(',', $value);
    }

    /**
     * The Mutator for 'air_temp' attribute
     *
     * @param $value
     */
    public function setAirTempAttribute($value)
    {
        $this->attributes['air_temp'] = implode(',', $value);
    }

    /**
     * The Mutator for 'bar_press' attribute
     *
     * @param $value
     */
    public function setBarPressAttribute($value)
    {
        $this->attributes['bar_press'] = implode(',', $value);
    }

    /**
     * The Mutator for 'wind_speed' attribute
     *
     * @param $value
     */
    public function setWindSpeedAttribute($value)
    {
        $this->attributes['wind_speed'] = implode(',', $value);
    }

    /**
     * Display first date
     *
     * @return mixed
     */
    public static function getFirstDate()
    {
        $rowFirst = EnviromentalData::findOrFail(1);
        return $rowFirst->data_recorded;
    }

    /**
     * Display last date
     *
     * @return mixed
     */
    public static function getLastDate()
    {
        $rowLast = EnviromentalData::all()->last();
        return $rowLast->data_recorded;
    }
}
