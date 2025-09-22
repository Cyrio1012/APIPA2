<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use proj4php\Proj4php;
use proj4php\Proj;
use proj4php\Point;
use Illuminate\Support\Facades\DB;

class conv extends Controller
{
    //
    function updateMiss()
    {
        $proj4 = new Proj4php();
        $utm = new Proj('EPSG:32738', $proj4); // UTM zone 38S
        $wgs84 = new Proj('EPSG:4326', $proj4); // WGS84

        // Récupérer les enregistrements avec x_long ou y_lat null
        $rows = DB::table('depuisavril')
            ->whereNull('x_long')
            ->orWhereNull('y_lat')
            ->get();

        foreach ($rows as $row) {
            if ($row->x_coord && $row->y_coord) {
                $point = new Point($row->x_coord, $row->y_coord, $utm);
                $converted = $proj4->transform($wgs84, $point);

                DB::table('depuisavril')
                    ->where('id', $row->id)
                    ->update([
                        'x_long' => $converted->x,
                        'y_lat' => $converted->y,
                    ]);
            }
        }
    }
}
