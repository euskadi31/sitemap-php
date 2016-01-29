<?php
/**
 * @package     Sitemap
 * @author      David Bou <contact@boudavid.com>
 * @copyright   Copyright (c) 2015 Axel Etcheverry (https://twitter.com/euskadi31)
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * @namespace
 */
namespace Euskadi31\Component\Sitemap\Tests\Writer;

use Euskadi31\Component\Sitemap\Extension\ImageSitemapExtension;

class ImageSitemapExtensionTest extends \PHPUnit_Framework_TestCase
{
    public function testInterface()
    {
        $extension = new ImageSitemapExtension();

        $this->assertInstanceOf(
            '\Euskadi31\Component\Sitemap\Writer\SitemapExtensionInterface',
            $extension
        );
    }
}
