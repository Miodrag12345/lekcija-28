<?php

namespace App\Http\Requests;

use App\Rules\UserClient;
use App\Rules\UserTrcuker;
use Illuminate\Foundation\Http\FormRequest;

class UpdateShipmentRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',

            'from_city' => 'required|string|max:100',
            'from_country' => 'required|string|max:100',

            'to_city' => 'required|string|max:100',
            'to_country' => 'required|string|max:100',

            'price' => 'required|numeric|min:0',

            'status' => 'required|in:in_progress,unassigned,completed,problem ',



            'details' => 'nullable|string|max:1000',
            'user_id'=>
            [
                'required',
                new UserTrcuker()
            ],
            'client_id'=>['required',
                 new UserClient()
                ]

        ];
    }
}
