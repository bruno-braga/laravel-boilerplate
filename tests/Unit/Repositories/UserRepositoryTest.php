<?php

namespace Tests\Unit\Repositories;

use Tests\TestCase;

use Modules\User\Repositories\UserRepository;

class UserRepositoryTest extends TestCase
{
    private $repository;

    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        $this->repository = $this->app->make(UserRepository::class);
    }

    /**
     * @test
     * @return void
     */
    public function get_user_by_id__should_get_user(): void
    {
        $data = $this->repository->getUserById();
        $this->assertEquals($data['id'], 1);
    }
}