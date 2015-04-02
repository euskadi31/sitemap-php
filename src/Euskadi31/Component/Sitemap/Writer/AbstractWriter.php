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

abstract class AbstractWriter implements WriterInterface
{
    /**
     * @var integer
     */
    protected $compression_level = -1;

    /**
     * @var boolean
     */
    protected $compression = false;

    /**
     * Set compression
     *
     * @param bool $compression
     */
    public function setCompression($compression)
    {
        $this->compression = (bool) $compression;

        return $this;
    }

    /**
     * Check if compression is used
     *
     * @return boolean
     */
    public function hasCompression()
    {
        return (bool) $this->compression;
    }

    /**
     * Set compression level
     *
     * @param integer $level
     */
    public function setCompressionLevel($level)
    {
        $this->compression_level = (int) $level;

        return $this;
    }

    /**
     * Get compression level
     *
     * @return integer
     */
    public function getCompressionLevel()
    {
        return (int) $this->compression_level;
    }

    public function render()
    {
        $content = $this->doRender();

        if ($this->hasCompression()) {
            $content = gzencode($content, $this->compression_level);
        }

        return $content;
    }
}
