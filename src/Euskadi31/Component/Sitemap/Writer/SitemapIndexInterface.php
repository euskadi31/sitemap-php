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

interface SitemapIndexInterface
{
    /**
     * Add sitemap
     *
     * @param string   $loc     The absolute url to sitemap file.
     * @param DateTime $lastmod Identifies the time that the corresponding Sitemap file was modified.
     */
    public function addSitemap($loc, DateTime $lastmod = null);
}
