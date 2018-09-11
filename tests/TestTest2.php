<?php
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
}


