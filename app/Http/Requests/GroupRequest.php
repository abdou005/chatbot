<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GroupRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'desc' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,jpg,png|dimensions:max_width=1200,max_height=1200'
        ];
        if ($this->id) {
            $validateRule = [
                'title' => 'required|string|max:255',
                'desc' => 'required|string|max:255',
                'image' => 'image|mimes:jpeg,jpg,png|dimensions:max_width=1200,max_height=1200'
            ];
        }
        return $validateRule;
    }
}