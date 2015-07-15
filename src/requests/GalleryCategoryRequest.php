<?php namespace N1n7aXIII\Gallery\Requests;

use App\Http\Requests\Request;

class GalleryCategoryRequest extends Request {

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
        // For create method.
        if ($this->method() == 'POST')
            return [
                'name' => 'required|unique:gallery_categories',
                'alias' => 'unique:gallery_categories',
                'thumbnail' => 'image|max:10000',
            ];

        // For other (PUT, PATCH) methods.
        return [
            'name' => 'required|unique:gallery_categories,name,'.$this->route()->getParameter('gallery'),
            'alias' => 'unique:gallery_categories,name,'.$this->route()->getParameter('gallery'),
            'thumbnail' => 'image|max:10000',
        ];
    }

}
