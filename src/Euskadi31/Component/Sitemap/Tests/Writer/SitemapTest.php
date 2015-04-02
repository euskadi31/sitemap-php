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

use Euskadi31\Component\Sitemap\Writer\Sitemap;
use DateTime;

class SitemapTest extends \PHPUnit_Framework_TestCase
{
    public function testInterface()
    {
        $writer = new Sitemap();

        $this->assertInstanceOf(
            '\Euskadi31\Component\Sitemap\Writer\SitemapInterface',
            $writer
        );
    }

    public function testRender()
    {
        $writer = new Sitemap();

        $writer->addUrl('https://www.domain.tld/my/page1.html');

        $writer->addUrl(
            'https://www.domain.tld/my/page2.html',
            new DateTime('2015-03-09 18:00:00')
        );

        $writer->addUrl(
            'https://www.domain.tld/my/page3.html',
            new DateTime('2015-03-09 18:01:00'),
            Sitemap::CHANGEFREQ_DAILY
        );

        $writer->addUrl(
            'https://www.domain.tld/my/page4.html',
            new DateTime('2015-03-09 18:02:00'),
            Sitemap::CHANGEFREQ_HOURLY,
            0.8
        );

        $this->assertEquals(
            file_get_contents(__DIR__ . '/../_files/sitemap.xml'),
            $writer->render()
        );
    }

    public function testRenderCompressed()
    {
        $writer = new Sitemap();

        $this->assertFalse($writer->hasCompression());

        $writer->setCompression(true);

        $this->assertTrue($writer->hasCompression());

        $this->assertEquals(-1, $writer->getCompressionLevel());

        $writer->setCompressionLevel(9);
        $this->assertEquals(9, $writer->getCompressionLevel());

        $writer->addUrl('https://www.domain.tld/my/page1.html');

        $writer->addUrl(
            'https://www.domain.tld/my/page2.html',
            new DateTime('2015-03-09 18:00:00')
        );

        $writer->addUrl(
            'https://www.domain.tld/my/page3.html',
            new DateTime('2015-03-09 18:01:00'),
            Sitemap::CHANGEFREQ_DAILY
        );

        $writer->addUrl(
            'https://www.domain.tld/my/page4.html',
            new DateTime('2015-03-09 18:02:00'),
            Sitemap::CHANGEFREQ_HOURLY,
            0.8
        );

        $this->assertEquals(
            gzencode(file_get_contents(__DIR__ . '/../_files/sitemap.xml'), 9),
            $writer->render()
        );
    }
}
