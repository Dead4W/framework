<?php
/**
 * @copyright Bluz PHP Team
 * @link      https://github.com/bluzphp/skeleton
 */

namespace Bluz\Tests\Proxy;

use Bluz\Config\Config as Target;
use Bluz\Proxy\Config as Proxy;
use Bluz\Tests\FrameworkTestCase;

/**
 * Proxy Test
 *
 * @package  Bluz\Tests\Proxy
 * @author   Anton Shevchuk
 */
class ConfigTest extends FrameworkTestCase
{
    public function testGetProxyInstance()
    {
        self::assertInstanceOf(Target::class, Proxy::getInstance());
    }

    public function testGetConfigurationDataOfApplication()
    {
        // merged
        //  - configs/default/
        //  - configs/testing/
        // hardcoded numbers of configuration items
        self::assertCount(14, Proxy::get());
        self::assertEquals(['foo' => 'bar'], Proxy::get('test'));
        self::assertEquals('bar', Proxy::get('test', 'foo'));
    }
}
