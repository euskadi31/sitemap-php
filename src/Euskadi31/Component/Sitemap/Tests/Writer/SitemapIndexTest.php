<?php
/**
 * @package     Sitemap
 * @author      Axel Etcheverry <axel@etcheverry.biz>
 * @copyright   Copyright (c) 2015 Axel Etcheverry (https://twitter.com/euskadi31)
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * @namespace
 */
namespace Euskadi31\Component\Sitemap\Tests\Writer;

use Euskadi31\Component\Sitemap\Writer\SitemapIndex;
use DateTime;

class SitemapIndexTest extends \PHPUnit_Framework_TestCase
{
    public function testInterface()
    {
        $writer = new SitemapIndex();

        $this->assertInstanceOf(
            '\Euskadi31\Component\Sitemap\Writer\SitemapIndexInterface',
            $writer
        );
    }

    public function testRender()
    {
        $writer = new SitemapIndex();

        $writer->addSitemap('https://www.domain.tld/sitemap_product.xml');

        $writer->addSitemap(
            'https://www.domain.tld/sitemap_category.xml',
            new DateTime('2015-03-09 18:00:00')
        );

        $this->assertEquals(
            file_get_contents(__DIR__ . '/../_files/sitemap_index.xml'),
            $writer->render()
        );
    }

    public function testRenderCompressed()
    {
        $writer = new SitemapIndex();

        $this->assertFalse($writer->hasCompression());

        $writer->setCompression(true);

        $this->assertTrue($writer->hasCompression());

        $this->assertEquals(-1, $writer->getCompressionLevel());

        $writer->setCompressionLevel(9);

        $this->assertEquals(9, $writer->getCompressionLevel());

        $writer->addSitemap('https://www.domain.tld/sitemap_product.xml');

        $writer->addSitemap(
            'https://www.domain.tld/sitemap_category.xml',
            new DateTime('2015-03-09 18:00:00')
        );

        $this->assertEquals(
            gzencode(file_get_contents(__DIR__ . '/../_files/sitemap_index.xml'), 9),
            $writer->render()
        );
    }
}
