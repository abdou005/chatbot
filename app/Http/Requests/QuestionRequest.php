<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionRequest extends FormRequest
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
            'question' => 'required|string|max:255',
            'response' => 'required|string|max:255',
            'group' => 'required',
        ];
        if ($this->id) {
            $validateRule = [
                'question' => 'required|string|max:255',
                'response' => 'required|string|max:255',
            ];
        }
        return $validateRule;
    }
}