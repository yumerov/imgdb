<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;

/**
 * Class TagStoreRequest
 *
 * @package App\Http\Requests
 */
class TagStoreRequest extends BaseRequest
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
