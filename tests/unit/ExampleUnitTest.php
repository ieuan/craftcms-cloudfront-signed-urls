<?php
/**
 * cloudfront-private plugin for Craft CMS 3.x
 *
 * A small plugin to sign cloudfront urls
 *
 * @link      https://www.3ejoueur.com
 * @copyright Copyright (c) 2022 3ejoueur
 */

namespace overdog\cloudfrontprivatetests\unit;

use Codeception\Test\Unit;
use UnitTester;
use Craft;
use overdog\cloudfrontprivate\Cloudfrontprivate;

/**
 * ExampleUnitTest
 *
 *
 * @author    3ejoueur
 * @package   Cloudfrontprivate
 * @since     1.0.0
 */
class ExampleUnitTest extends Unit
{
    // Properties
    // =========================================================================

    /**
     * @var UnitTester
     */
    protected $tester;

    // Public methods
    // =========================================================================

    // Tests
    // =========================================================================

    /**
     *
     */
    public function testPluginInstance()
    {
        $this->assertInstanceOf(
            Cloudfrontprivate::class,
            Cloudfrontprivate::$plugin
        );
    }

    /**
     *
     */
    public function testCraftEdition()
    {
        Craft::$app->setEdition(Craft::Pro);

        $this->assertSame(
            Craft::Pro,
            Craft::$app->getEdition()
        );
    }
}
