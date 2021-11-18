<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJobFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'job_type' => 'required',
            'job_category' => 'required',
            'medical_center' => 'required',
            'profession' => 'required',
            'speciality' => 'required',
            'state' => 'required',
            'city' => 'required',
            'suburb' => 'required',
            'rate' => 'required',
            'work_days' => 'required',
            'title' => 'required|max:500|unique:jobs',
            'from_date' => 'required',
            'to_date' => 'required',
            'address' => 'required|max:500',
            'description' => 'required',
            'practice_offer' => 'required',
            'essential_criteria' => 'required',
        ];
    }
}
