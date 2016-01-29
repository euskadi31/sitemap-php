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
namespace Euskadi31\Component\Sitemap\Writer;

interface SitemapExtensionInterface
{
    /**
     * Apply urlset
     *
     * @param XMLWriter $xml The xml to apply the extension on.
     */
    public function applyUrlset($xml);

    /**
     * Apply url
     *
     * @param XMLWriter $xml  The xml to apply the extension on.
     * @param array     $data The extension data to add.
     */
    public function applyUrl($xml, $data);
}
