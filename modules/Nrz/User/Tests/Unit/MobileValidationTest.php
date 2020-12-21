<?php

namespace Nrz\User\Tests\Unit;

use Nrz\User\Rules\ValidPhone;
use PHPUnit\Framework\TestCase;

class MobileValidationTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testMobileCanNotLessThan_10_Char()
    {
        $result = (new ValidPhone())->passes('', '12345678');
        $this->assertEquals(0, $result);
    }
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testMobileCanNotMoreThan_10_Char()
    {
        $result = (new ValidPhone())->passes('', '1234511165578');
        $this->assertEquals(0, $result);
    }
}
