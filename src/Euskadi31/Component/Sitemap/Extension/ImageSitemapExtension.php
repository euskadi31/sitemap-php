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
namespace Euskadi31\Component\Sitemap\Extension;

use Euskadi31\Component\Sitemap\Writer\SitemapExtensionInterface;

class ImageSitemapExtension implements SitemapExtensionInterface
{
    public function applyUrlset($xml)
    {
        $xml->writeAttributeNS('xmlns', 'image', null, 'http://www.google.com/schemas/sitemap-image/1.1');
    }

    public function applyUrl($xml, $data)
    {
        if (isset($data['image']['loc'])) {
            $xml->startElementNS('image', 'image', null);
            $xml->writeElementNS('image', 'loc', null, $data['image']['loc']);
            $xml->endElement();
        }
    }
}
