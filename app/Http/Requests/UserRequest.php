<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UserRequest extends FormRequest
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
    public function rules(Request $request)
    {
        $rules = [
            'lastname' => 'required|alpha_dash',
            'firstname' => 'required|alpha_dash',
            'email' => 'required|email',
            'university' => 'required|alpha_dash',
        ];

        if (!$request->id) {
            $rules['email'] = 'required|email|unique:users';
        }

        if ($request->password) {
            $rules['password'] = 'required|min:8|confirmed';
        }

        return $rules;
    }
}
