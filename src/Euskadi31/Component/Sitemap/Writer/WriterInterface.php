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

interface WriterInterface
{
    /**
     * Set compression
     *
     * @param boolean $compression
     */
    public function setCompression($compression);

    /**
     * Check if compression is used
     *
     * @return boolean
     */
    public function hasCompression();

    /**
     * Set compression level
     *
     * @param integer $level
     */
    public function setCompressionLevel($level);

    /**
     * Get compression level
     *
     * @return integer
     */
    public function getCompressionLevel();

    /**
     *
     * @return string
     */
    public function doRender();

    /**
     * Render xml
     *
     * @return string
     */
    public function render();
}
