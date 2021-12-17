<?php

namespace App\Http\Requests;


use Illuminate\Support\Facades\Auth;

class UserRequest extends BaseRequest
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
            'email' => ['required', 'email'],
            'password' => ['required', 'min:6']
        ];
    }

    /**
     * Russian language error messages
     *
     * @return string[]
     */
    public function messages()
    {
        return [
            'name.required' => 'Имя обязательно для заполнения',
            'name.string' => 'Неверный ввод',
            'name.min' => 'Слишком короткое имя',
            'name.max' => 'Слишком длинное имя',
            'email.required' => 'Email обязателен для заполнения',
            'email.email' => 'Неверно введен email',
            'password.required' => 'Пароль обязателен для ввода',
            'password.min' => 'Пароль должен быть шестизначным',
        ];
    }


    /**
     * Returns a user id
     *
     * @return int|null
     */
    public function getUserId(): ?int
    {
        return $this->get('id');
    }

    /**
     * Returns a user Email
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->get('email');
    }

    /**
     * Returns an array of necessary params for creatin or updating user data
     *
     * @return array
     */
    public function getData(): array
    {
        return [
            'name' => $this->get('name'),
            'email' => $this->get('email'),
            'password' => bcrypt($this->get('password'))
        ];
    }
}
