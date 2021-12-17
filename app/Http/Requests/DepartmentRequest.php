<?php

namespace App\Http\Requests;


class DepartmentRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => ['nullable', 'integer'],
            'name' => ['required', 'string', 'min:3', 'max:20'],
            'description' => ['required', 'string'],
            'logo' => ['nullable', 'string'],
            'users' => ['nullable', 'array'],
        ];
    }

    /**
     * Returns an array of users to be attached to this department
     *
     * @return array
     */
    public function getUsers(): array
    {
        return $this->get('users');
    }

    /**
     * Returns a department id
     *
     * @return int
     */
    public function getDepartmentId(): int
    {
        return $this->get('id');
    }

    /**
     * Returns an array of necessary params for creatin or updating department data
     *
     * @return array
     */
    public function getData(): array
    {
        return [
            'name' => $this->get('name'),
            'description' => $this->get('description'),
            'logo' => $this->get('logo'),
        ];
    }
}
