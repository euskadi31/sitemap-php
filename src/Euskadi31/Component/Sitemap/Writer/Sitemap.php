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

class Sitemap extends AbstractWriter implements SitemapInterface
{
    const CHANGEFREQ_ALWAYS     = 'always';
    const CHANGEFREQ_HOURLY     = 'hourly';
    const CHANGEFREQ_DAILY      = 'daily';
    const CHANGEFREQ_WEEKLY     = 'weekly';
    const CHANGEFREQ_MONTHLY    = 'monthly';
    const CHANGEFREQ_YEARLY     = 'yearly';
    const CHANGEFREQ_NEVER      = 'never';

    protected $urls;

    public function __construct()
    {
        $this->urls = new SplQueue();
        $this->urls->setIteratorMode(SplQueue::IT_MODE_DELETE);
    }

    public function addUrl($loc, DateTime $lastmod = null, $changefreq = null, $priority = 0.5)
    {
        $this->urls->enqueue([
            'loc'           => $loc,
            'lastmod'       => is_null($lastmod) ? null : $lastmod->format(DateTime::RFC3339),
            'changefreq'    => $changefreq,
            'priority'      => $priority
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
        $xml->startElement('urlset');
        $xml->writeAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');
        $xml->writeAttributeNS('xmlns', 'xsi', null, 'http://www.w3.org/2001/XMLSchema-instance');
        $xml->writeAttributeNS(
            'xsi',
            'schemaLocation',
            null,
            'http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd'
        );

        foreach ($this->urls as $url) {

            $xml->startElement('url');

            $xml->writeElement('loc', $url['loc']);

            if (!empty($url['lastmod'])) {
                $xml->writeElement('lastmod', $url['lastmod']);
            }

            if (!empty($url['changefreq'])) {
                $xml->writeElement('changefreq', $url['changefreq']);
            }

            $xml->writeElement('priority', $url['priority']);

            $xml->endElement(); // url
        }

        $xml->endElement(); // urlset
        $xml->endDocument();

        return $xml->flush();
    }
}
