<?php
/**
 * Created by PhpStorm.
 * User: GDNT
 * Date: 26-Oct-16
 * Time: 11:38 AM
 */

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\ContactPerson;
use App\Models\District;
use App\Models\PostedJob;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    /**
     * @param Request $request
     * @return mixed
     *
     */
    public static function getContactPersonDetails(Request $request)
    {
        $id = Auth::guard('employer')->user()->id;
        $contact_person = ContactPerson::where('employer_id', $id)->orderBy('contact_name')->pluck('contact_name', 'id');
        return $contact_person;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public static function searchJob(Request $request)
    {
        $data = PostedJob::select("post_name as name")->where("post_name", "LIKE", "%{$request->input('query')}%")->get();
        return response()->json($data);
    }


    public static function searchByCity(Request $request)
    {
        $data = City::select("name as name")->where("name", "LIKE", "%{$request->input('city')}%")->get();
        return response()->json($data);
    }

}