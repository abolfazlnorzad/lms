<?php

namespace Nrz\User\Tests\Unit;

use Nrz\User\Rules\ValidPassword;
use PHPUnit\Framework\TestCase;

class PasswordValidationTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testPasswordCanNotLess_8_Char()
    {
        $result = (new ValidPassword())->passes('', '1234545');
        $this->assertEquals(0, $result);
    }


    public function testPasswordCanIncludeInt()
    {
        $result = (new ValidPassword())->passes('', 'aaAAAsdfsdfsdf');
        $this->assertEquals(0, $result);
    }

    public function testPasswordCanIncludeUpperCase()
    {
        $result = (new ValidPassword())->passes('', '54564sdfsdf');
        $this->assertEquals(0, $result);
    }
    public function testPasswordCanIncludeLowerCase()
    {
        $result = (new ValidPassword())->passes('', '5465AALKHHH54');
        $this->assertEquals(0, $result);
    }
}
