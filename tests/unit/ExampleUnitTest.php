<?php

/**
 * cloudfront-private plugin for Craft CMS 3.x
 *
 * A small plugin to sign cloudfront urls
 *
 * @link      https://www.3ejoueur.com
 * @copyright Copyright (c) 2022 3ejoueur
 */

namespace troisiemejoueur\cloudfrontsignedurlstests\unit;

use Codeception\Test\Unit;
use UnitTester;
use Craft;
use troisiemejoueur\cloudfrontsignedurlstests\Cloudfrontsignedurls;


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
         Cloudfrontsignedurls::class,
         Cloudfrontsignedurls::$plugin
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
