<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\ApiErrorResponse;

class LeaveRequest extends FormRequest
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
            'apply_date' => 'required |date_format:"Y-m-d H:i:s"',
            'leave_from' => 'required | date_format:"Y-m-d H:i:s"',
            'leave_to' => 'required | date_format:"Y-m-d H:i:s"',
            'leave_type' => 'required',
            'leave_remark' => 'required',
        ];
    }
}
