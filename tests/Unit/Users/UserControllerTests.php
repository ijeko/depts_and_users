<?php

namespace Tests\Unit\Users;

use App\Http\Controllers\UserController;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\User\UserFactory;
use Tests\TestCase;

class UserControllerTests extends TestCase
{
    /**
     * @test
     */
    public function store_shuold_return_user_json_resource_status_200()
    {
        $userParams = [
            'id' => '1',
            'name' => 'User Name',
            'email' => 'some@test.email',
        ];
        $user = new User();
        $user->id = $userParams['id'];
        $user->name = $userParams['name'];
        $user->email = $userParams['email'];

        $userRequest = $this->createStub(UserRequest::class);

        $userFactory = $this->getMockBuilder(UserFactory::class)
            ->getMock();
        $userFactory->expects($this->once())
            ->method('createFromRequest')
            ->willReturn($user);
        $userRepository = $this->getMockBuilder(UserRepository::class)
            ->getMock();
        $userRepository->expects($this->never())
            ->method('findByEmail')
            ->willReturn(null);

        $userController = new UserController($userRepository, $userFactory);

        $response = $userController->store($userRequest);
        $result = json_decode($response->getContent());

        $this->assertIsObject($result);
        $this->assertObjectHasAttribute('id', $result);
        $this->assertEquals($userParams['id'], $result->id);
        $this->assertObjectHasAttribute('name', $result);
        $this->assertEquals($userParams['name'], $result->name);
        $this->assertObjectHasAttribute('email', $result);
        $this->assertEquals($userParams['email'], $result->email);
    }
}
