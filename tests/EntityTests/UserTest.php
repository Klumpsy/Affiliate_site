<?php

namespace App\Tests\EntityTests;

use PHPUnit\Framework\TestCase;
use App\Entity\User;

class UserTest extends TestCase
{
    private $user;

    public function setUp(): void
    {
        $this->user = new User();
    }

    public function test_if_username_is_set_on_object()
    {

        $this->user->setUsername('testUserName');

        $this->assertSame('testUserName', $this->user->getUsername() );
        $this->assertNotSame('notSame', $this->user->getUsername());
    }

    public function test_if_user_has_only_one_role()
    {
        $this->user->setRoles(['ROLE_USER']);
        $this->assertIsArray($this->user->getRoles(), 'Assert that roles is an array');

        $this->assertSame('ROLE_USER', $this->user->getRoles()[0]);
        $this->assertSame(1, count($this->user->getRoles()));
    }

    public function test_if_user_has_multiple_roles()
    {
        $this->user->setRoles(['ROLE_USER', 'ROLE_ADMIN']);
        $this->assertIsArray($this->user->getRoles(), 'Assert that roles is an array');

        $this->assertSame('ROLE_USER', $this->user->getRoles()[0]);
        $this->assertSame('ROLE_ADMIN', $this->user->getRoles()[1]);
        $this->assertCount(2, $this->user->getRoles());
    }

    public function test_if_user_is_not_verified_by_default()
    {
        $this->assertSame(false, $this->user->isVerified());
    }

    public function test_if_user_can_be_verified()
    {
        $this->user->setIsVerified(true);
        $this->assertSame(true, $this->user->isVerified());
    }

    public function test_if_user_has_no_blogs_by_default()
    {
        $this->assertCount(0, $this->user->getBlogs());
    }
}