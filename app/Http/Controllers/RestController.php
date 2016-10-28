<?php
/**
 * Created by PhpStorm.
 * User: GDNT
 * Date: 26-Oct-16
 * Time: 11:38 AM
 */

namespace app\Http\Controllers;

use App\Models\District;
use Illuminate\Http\Request;

class RestController extends Controller
{
    /**
     * @param Request $request
     * @return mixed
     */
    public static function getDistricts(Request $request)
    {
        $id = $request->city_id;
        return District::where('city_id', $id)->get();
    }

}