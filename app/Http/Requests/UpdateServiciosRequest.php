<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateServiciosRequest extends FormRequest {

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
		return [
            'itemId' => 'required|unique:servicios,itemId,'.$this->servicios, 
            'basePrice' => 'required', 
            'type' => 'required', 
            'itemNumber' => 'required', 
            'itemNumCurrent' => 'required', 
            
		];
	}
}
