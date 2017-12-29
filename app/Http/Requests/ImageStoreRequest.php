<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;

class ImageStoreRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|unique:images',
            'tags' => 'required|array|min:1',
            'file' => 'required|image|max:5000',
        ];
    }
}
