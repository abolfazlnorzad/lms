<?php

namespace Nrz\User\Tests\Unit;


use Nrz\User\Services\verifyCodeService;
use Tests\TestCase;

class VerifyCodeServiceTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCreateValidCode()
    {
        $code = verifyCodeService::createCode();
        $this->assertIsNumeric($code);
        $this->assertLessThanOrEqual(999999, $code, 'کد بزرگتر از 999999است');
        $this->assertGreaterThanOrEqual(100000, $code, 'کد بزرگتر از 100000است');
    }

    public function testStoreCodeInCache()
    {
        $code = verifyCodeService::createCode();
        verifyCodeService::store(3,$code);
        $this->assertEquals($code,cache()->get('verify_code_3'));
    }

}
