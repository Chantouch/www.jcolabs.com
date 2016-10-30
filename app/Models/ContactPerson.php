<?php

namespace App\Models;

use App\Model\backend\Employer;
use Illuminate\Database\Eloquent\Model as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Request;

/**
 * Class ContactPerson
 * @package App\Models
 * @version October 24, 2016, 11:42 pm UTC
 */
class ContactPerson extends Model
{
    use SoftDeletes;

    public $table = 'contact_people';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'contact_name',
        'department_id',
        'position_id',
        'employer_id',
        'phone_number',
        'email'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'contact_name' => 'string',
        'department_id' => 'integer',
        'position_id' => 'integer',
        'employer_id' => 'integer',
        'phone_number' => 'string',
        'email' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'contact_name' => 'required|between:3,100|unique:contact_people,contact_name',
        'department_id' => 'required',
        'position_id' => 'required',
        'phone_number' => 'required|numeric|unique:contact_people,phone_number',
        'email' => 'email|required|max:255|unique:contact_people,email'
    ];

    public function rules()
    {
        $contact = new ContactPerson();

        switch (Request::method()) {
            case 'GET':
            case 'DELETE': {
                return [];
            }
            case 'POST': {
                return [
                    'contact_name' => 'required|between:3,100|unique:contact_people,contact_name',
                    'department_id' => 'required',
                    'position_id' => 'required',
                    'phone_number' => 'required|numeric|unique:contact_people,phone_number',
//                    'email' => 'email|required|max:255|unique:contact_people,email'
                ];
            }
            case 'PUT':
            case 'PATCH': {
                return [
                    'contact_name' => 'required|between:3,100|unique:contact_people,contact_name',
                    'department_id' => 'required',
                    'position_id' => 'required',
                    'phone_number' => 'required|numeric|unique:contact_people,phone_number',
//                    'email' => 'email|required|max:255|unique:contact_people,email',
                    'email' => 'required|max:100|unique:employers,contact_people,' . $contact->id . ',id'

                ];
            }
            default:
                break;
        }
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department()
    {
        return $this->belongsTo(DepartmentType::class, 'department_id')->withTrashed();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id')->withTrashed();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function employer()
    {
        return $this->belongsTo(Employer::class, 'employer_id')->withTrashed();
    }


}
