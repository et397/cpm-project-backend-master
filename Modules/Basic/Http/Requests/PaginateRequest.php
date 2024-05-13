<?php
namespace Modules\Basic\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
/**
 * PaginateRequest
 * 使用在query param
 */
class PaginateRequest extends FormRequest
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'page' => 'nullable|int',
            'perPage' => 'nullable|int',
            'order' => 'nullable|string',
        ];
    }


    public function queryParameters()
    {
        return [
            'page' => [
                'description' => '當前頁碼',
                'required' => false,
                'type' => 'integer',
                'example' => 1
            ],
            'perPage' => [
                'description' => '筆數',
                'required' => false,
                'type' => 'integer',
                'example' => 50
            ],
            'order' => [
                'description' => '排序',
                'required' => false,
                'type' => 'string',
                'example' => '{ "id": "desc" }'
            ],
        ];
    }
}
