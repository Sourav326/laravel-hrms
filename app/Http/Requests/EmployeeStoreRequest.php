<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\ApiErrorResponse;

class EmployeeStoreRequest extends FormRequest
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
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:employees',
            'mobile' => 'required',
            'emergency_mobile' => 'required',
            'permanent_address' => 'required',
            'temporary_address' => 'required',
            'nationality' => 'required',
            'marital_status' => 'required',
            'blood_type' => 'required',
            'gender' => 'required',
            'dob' => 'required',
            'birth_place' => 'required',
            'department' => 'required',
            'job_position' => 'required',
            'manager' => 'required',
            'work_email' => 'required|email|unique:employees',
            'bank_name' => 'required',
            'bank_branch' => 'required',
            'account_holder_name' => 'required',
            'account_type' => 'required',
            'account_nmber' => 'required',
            'ifsc' => 'required',
            'employee_code' => 'required',
            'overtime_pay' => 'required',
            'deductions' => 'required',
            'net_pay' => 'required',
        ];
    }
}
