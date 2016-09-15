<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Exceptions\InaccessibleLocationException;

class MoveUser extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @throws 
     */
    public function authorize()
    {
        if (! $this->user()->canReach($this->route()->location)) {
            throw new InaccessibleLocationException;
        }

        if (! $this->route()->location->userCanEnter) {
            throw new InaccessibleLocationException;
        }

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
