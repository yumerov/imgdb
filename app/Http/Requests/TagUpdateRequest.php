<?php

namespace App\Http\Requests;

use App\Http\Requests\TagRequest;

class TagUpdateRequest extends TagRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:tags,slug,' . $this->tag->id,
        ];
    }
}
