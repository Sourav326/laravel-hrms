<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\ApiErrorResponse;

class JobRequest extends FormRequest
{
    use ApiErrorResponse;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'designation' => 'required',
            'no_of_positions' => 'integer | required',
            'department' => 'required',
            'expected_compensation' => 'required',
            'requested_by' => 'required',
            'expected_compensation' => 'required',
            'expected_by' => 'required | date_format:"Y-m-d H:i:s"',
            'publish_on_website' => 'required | in:0,1',
            'status' => 'required | in:0,1,2,3',
        ];
    }
}
