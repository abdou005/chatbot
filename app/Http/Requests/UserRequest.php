<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
    public function rules()
    {

        $validateRule = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'image' => 'image|mimes:jpeg,jpg,png|dimensions:max_width=900,max_height=900'
        ];
        if ($this->id) {
            $userId = $this->id;
            $validateRule = [
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => [
                    'required', 'email', 'max:255',
                    Rule::unique('users')->where(function ($query) use ($userId) {
                        $query->where('id', '!=', $userId);
                    }),
                ],
                'password' => 'required|string|min:8',
                'image' => 'image|mimes:jpeg,jpg,png|dimensions:max_width=900,max_height=900'
            ];
        }
        return $validateRule;
    }
}