<?php
/**
 * cloudfront-private plugin for Craft CMS 3.x
 *
 * A small plugin to sign cloudfront urls
 *
 * @link      https://www.3ejoueur.com
 * @copyright Copyright (c) 2022 3ejoueur
 */

namespace overdog\cloudfrontprivate\twigextensions;

use overdog\cloudfrontprivate\Cloudfrontprivate;

use Craft;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

/**
 * @author    3ejoueur
 * @package   Cloudfrontprivate
 * @since     1.0.0
 */
class CloudfrontprivateTwigExtension extends AbstractExtension
{
    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'Cloudfrontprivate';
    }

    /**
     * @inheritdoc
     */
    public function getFilters()
    {
        return [
            new TwigFilter('someFilter', [$this, 'someInternalFunction']),
        ];
    }

    /**
     * @inheritdoc
     */
    public function getFunctions()
    {
        return [
            new TwigFunction('someFunction', [$this, 'someInternalFunction']),
        ];
    }

    /**
     * @param null $text
     *
     * @return string
     */
    public function someInternalFunction($text = null)
    {
        $result = $text . " in the way";

        return $result;
    }
}
