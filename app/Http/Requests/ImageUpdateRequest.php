<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;

/**
 * Class ImageUpdateRequest
 *
 * @package App\Http\Requests
 */
class ImageUpdateRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|unique:images,title,' . $this->image->id,
            'tags' => 'required|array|min:1',
            'file' => 'nullable|image|max:5000',
        ];
    }
}
