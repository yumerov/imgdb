<?php

namespace App\Http\Requests;

use App\Http\Requests\TagRequest;

class TagStoreRequest extends TagRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:tags',
        ];
    }
}
