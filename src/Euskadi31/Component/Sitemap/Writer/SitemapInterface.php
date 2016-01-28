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

use DateTime;

interface SitemapInterface
{
    /**
     * Add url
     *
     * @param string   $loc         URL of the page.
     * @param DateTime $lastmod     The date of last modification of the file.
     * @param string   $changefreq  How frequently the page is likely to change.
     * @param float    $priority    The priority of this URL relative to other URLs on your site.
     */
    public function addUrl($loc, DateTime $lastmod = null, $changefreq = null, $priority = 0.5, array $options = []);
}
