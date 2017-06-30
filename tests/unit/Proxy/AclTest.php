<?php
/**
 * @copyright Bluz PHP Team
 * @link      https://github.com/bluzphp/skeleton
 */

/**
 * @namespace
 */

namespace Bluz\Tests\Proxy;

use Bluz\Acl\Acl as Target;
use Bluz\Proxy\Acl as Proxy;
use Bluz\Tests\TestCase;

/**
 * Proxy Test
 *
 * @package  Bluz\Tests\Proxy
 * @author   Anton Shevchuk
 */
class AclTest extends TestCase
{
    /**
     * Test instance
     */
    public function testProxyInstance()
    {
        self::assertInstanceOf(Target::class, Proxy::getInstance());
    }
}