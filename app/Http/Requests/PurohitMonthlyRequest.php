<?php

namespace App\Http\Requests;

use App\Http\Requests\JBFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class PurohitMonthlyRequest extends JBFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Assuming the user is authorized to make this request.
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'mouza_name' => 'required',
            'land_jlno' => 'required',
            'khatian_no' => 'required',
            'plot_no' => 'required',
            'land_area' => 'required',
            'land_holdername' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'mouza_name.required' => 'Mouza Name is required',
            'land_jlno.required' => 'Land JL No is required',
            'khatian_no.required' => 'Khatian No is required',
            'plot_no.required' => 'Plot No is required',
            'land_area.required' => 'Land Area is required',
            'land_holdername.required' => 'Land Holder Name is required',
        ];
    }
}
