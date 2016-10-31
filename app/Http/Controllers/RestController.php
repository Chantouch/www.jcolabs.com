<?php
/**
 * Created by PhpStorm.
 * User: GDNT
 * Date: 26-Oct-16
 * Time: 11:38 AM
 */

namespace App\Http\Controllers;

use App\Models\ContactPerson;
use App\Models\District;
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

}