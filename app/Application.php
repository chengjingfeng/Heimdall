<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    public $incrementing = false;

    protected $primaryKey = 'appid';

    //
    public function icon()
    {
        return $this->icon;
    }

    public function iconView()
    {
        return asset('storage/'.$this->icon);
    }

    public function defaultColour()
    {
        // check if light or dark
        if($this->tile_background == 'light') return '#fafbfc';
        return '#161b1f';
    }

    public function class()
    {
        $name = $this->name;
        $name = preg_replace('/\PL/u', '', $name);    

        $class = '\App\SupportedApps\\'.$name.'\\'.$name;
        return $class;
    }

    public static function applist()
    {
        $list = [];
        $all = self::orderBy('name')->get();
        $list['null'] = 'None';
        foreach($all as $app) {
            $name = $app->name;
            $name = preg_replace('/\PL/u', '', $name);
        
            $list['\App\SupportedApps\\'.$name.'\\'.$name] = $app->name;
        }
        return $list;
    }


}