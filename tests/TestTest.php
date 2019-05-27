<?php
/**
 * A sample test for PHPUnit.
 * Run at commandline via: $ vendor/bin/phpunit --testdox tests/TestTest
 */
namespace tests;

use PHPUnit\Framework\TestCase;

final class TestTest extends TestCase
{
    public function testAStringEqualsAString()
    {
        $aString = 'This is a string.'; // Maybe this comes from a function or method you are testing.

        $this->assertEquals(
            'This is a string.',
            $aString
        );
    }

    public function testAlwaysFails()
    {
        $aString = 'This is another string.'; // Maybe this comes from a function or method you are testing.

        $this->assertNotEquals(
            'This is NOT a string.',
            $aString
        );
    }
}
