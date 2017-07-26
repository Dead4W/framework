<?php
/**
 * @copyright Bluz PHP Team
 * @link      https://github.com/bluzphp/framework
 */

namespace Bluz\Tests\Validator;

use Bluz\Tests;
use Bluz\Validator\Exception\ValidatorException;
use Bluz\Validator\Rule\RuleInterface;
use Bluz\Validator\Validator;
use Bluz\Validator\ValidatorChain;

/**
 * Class ValidatorTest
 *
 * @package Bluz\Tests\Validator
 */
class ValidatorTest extends Tests\FrameworkTestCase
{
    /**
     * Create new instance of validator
     */
    public function testStaticCreateShouldReturnNewValidatorChain()
    {
        self::assertInstanceOf(ValidatorChain::class, Validator::create());
    }

    /**
     * Every static call of exist Rule should be return a new instance of Rule
     */
    public function testStaticCallsShouldReturnNewValidatorRule()
    {
        self::assertInstanceOf(
            RuleInterface::class,
            Validator::array(
                function () {
                    return true;
                }
            )
        );
        self::assertInstanceOf(RuleInterface::class, Validator::string());
        self::assertInstanceOf(RuleInterface::class, Validator::notEmpty());
    }

    public function testStaticCallShouldCreateValidRule()
    {
        $validator = Validator::callback('is_int');

        self::assertTrue($validator->validate(42));
    }

    public function testStaticCallShouldAllowInvokeIt()
    {
        self::assertTrue(Validator::callback('is_int')(42));
    }

    /**
     * @expectedException \Bluz\Validator\Exception\ComponentException
     */
    public function testInvalidRuleClassShouldRaiseComponentException()
    {
        Validator::iDoNotExistSoIShouldThrowException();
    }
}
