<?php

namespace App\Http\Requests;

use http\Exception\RuntimeException;
use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
        return [
            'sort' => 'nullable|in:random,new,old'
        ];
    }

    /**
     * Get order by request param in url
     *
     * @return string
     */
    public function getOrder()
    {
        $sort = $this->route('sort');
        if ($sort === null) {
            return 'desc';
        }

        switch ($sort) {
            case 'new':
                return 'desc';
            case 'old':
                return 'asc';
            case 'random':
                return 'random';
            default:
                throw new RuntimeException('Unsupporting sort value parameter');
        }
    }
}
