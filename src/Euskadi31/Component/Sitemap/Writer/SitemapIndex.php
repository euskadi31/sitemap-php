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
namespace Euskadi31\Component\Sitemap\Writer;

use XMLWriter;
use DateTime;
use SplQueue;

class SitemapIndex extends AbstractWriter implements SitemapIndexInterface
{
    protected $sitemaps;

    public function __construct()
    {
        $this->sitemaps = new SplQueue();
        $this->sitemaps->setIteratorMode(SplQueue::IT_MODE_DELETE);
    }

    public function addSitemap($loc, DateTime $lastmod = null)
    {
        $this->sitemaps->enqueue([
            'loc'       => $loc,
            'lastmod'   => is_null($lastmod) ? null : $lastmod->format(DateTime::ISO8601)
        ]);

        return $this;
    }

    public function doRender()
    {
        $xml = new XMLWriter();
        $xml->openMemory();
        $xml->setIndent(true);
        $xml->setIndentString('  ');
        $xml->startDocument('1.0', 'UTF-8');
        $xml->startElement('sitemapindex');
        $xml->writeAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');
        $xml->writeAttributeNS('xmlns', 'xsi', null, 'http://www.w3.org/2001/XMLSchema-instance');
        $xml->writeAttributeNS(
            'xsi',
            'schemaLocation',
            null,
            'http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/siteindex.xsd'
        );

        foreach ($this->sitemaps as $sitemap) {

            $xml->startElement('sitemap');

            $xml->writeElement('loc', $sitemap['loc']);

            if (!empty($sitemap['lastmod'])) {
                $xml->writeElement('lastmod', $sitemap['lastmod']);
            }

            $xml->endElement(); // sitemap
        }

        $xml->endElement(); // sitemapindex
        $xml->endDocument();

        return $xml->flush();
    }
}
