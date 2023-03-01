<?php

namespace idunion\sdjwt;

use PHPUnit\Framework\TestCase;
use UnexpectedValueException;

final class SDJWTTest extends TestCase
{
    public const FIXTURES_DIR = __DIR__ . '/data/';
    /**
     * @test
     */
    public function testSplit()
    {
        $input = file_get_contents(SDJWTTest::FIXTURES_DIR . "presentation.txt");
        // test key resolution function
        $out = SDJWT::split($input, function (string $issuer): string {
            $input = file_get_contents(SDJWTTest::FIXTURES_DIR . "key.json");
            return $input;
        });
        $this->assertisObject($out);
    }
    /**
    * @test
    */
    public function testDecodeInvalidAudience()
    {
        $input = file_get_contents(SDJWTTest::FIXTURES_DIR . "presentation.txt");
        $this->expectException(UnexpectedValueException::class);
        $out = SDJWT::decode($input, function (string $issuer): string {
            $input = file_get_contents(SDJWTTest::FIXTURES_DIR . "key.json");
            return $input;
        }, "invalid", "XZOUco1u_gEPknxS78sWWg", true);
    }

    public function testDecodeValidAudience()
    {
        $input = file_get_contents(SDJWTTest::FIXTURES_DIR . "presentation.txt");
        $out = SDJWT::decode($input, function (string $issuer): string {
            $input = file_get_contents(SDJWTTest::FIXTURES_DIR . "key.json");
            return $input;
        }, "https://example.com/verifier", "XZOUco1u_gEPknxS78sWWg");
        $this->assertisObject($out);
    }

    public function testSecondPresentation()
    {
        $input = file_get_contents(SDJWTTest::FIXTURES_DIR . "presentation_2.txt");
        $out = SDJWT::decode($input, function (string $issuer): string {
            $input = file_get_contents(SDJWTTest::FIXTURES_DIR . "key.json");
            return $input;
        }, "https://example.com/verifier", "XZOUco1u_gEPknxS78sWWg");
        $this->assertisObject($out);
    }

    public function testDecodeValidOutput()
    {
        $input = file_get_contents(SDJWTTest::FIXTURES_DIR . "presentation.txt");
        $out = SDJWT::decode($input, function (string $issuer): string {
            $input = file_get_contents(SDJWTTest::FIXTURES_DIR . "key.json");
            return $input;
        }, "https://example.com/verifier", "XZOUco1u_gEPknxS78sWWg");
        $verified = file_get_contents(SDJWTTest::FIXTURES_DIR . "verified_contents.json");
        $verified = json_decode($verified);
        $this->assertEquals($verified, $out);
    }

    public function testDecodeValidOutputComplex()
    {
        $input = file_get_contents(SDJWTTest::FIXTURES_DIR . "presentation_complex.txt");
        $out = SDJWT::decode($input, function (string $issuer): string {
            $input = file_get_contents(SDJWTTest::FIXTURES_DIR . "key.json");
            return $input;
        }, "https://example.com/verifier", "XZOUco1u_gEPknxS78sWWg", false);
        $verified = file_get_contents(SDJWTTest::FIXTURES_DIR . "verified_complex.json");
        $verified = json_decode($verified);
        $this->assertEquals($verified, $out);
    }
}