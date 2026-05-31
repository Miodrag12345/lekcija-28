<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class NewShipmentRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',

            'fromCity' => 'required|string|max:100',
            'fromCountry' => 'required|string|max:100',

            'toCity' => 'required|string|max:100',
            'toCountry' => 'required|string|max:100',

            'price' => 'required|numeric|min:0',

            'status' => 'required|in:in_progress,unassigned,completed,problem ',

            'user_id' => 'required|exists:users,id',

            'details' => 'nullable|string|max:1000',
            'documents' =>'required|array',
            'documents. *'=>'file|mimes:jpg,jpeg,png,webp,pdf,doc,docx|max:10240',
             'clientId'
              => [
                 'required', new UserClient()
             ]
        ];
    }
}
