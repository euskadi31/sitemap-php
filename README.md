Sitemap [![Build Status](https://secure.travis-ci.org/euskadi31/sitemap-php.png)](http://travis-ci.org/euskadi31/sitemap-php)
=======

Sitemap generator

Example
-------

Sitemap
~~~php
require 'path/to/vendor/autoload.php';

$sitemap = new Euskadi31\Component\Sitemap\Writer\Sitemap();

//$sitemap->setCompression(true);
//$sitemap->setCompressionLevel(9);

$sitemap->addUrl('https://www.domain.tld/my/page1.html');

$sitemap->addUrl(
    'https://www.domain.tld/my/page2.html',
    new DateTime('2015-03-09 18:00:00')
);

$sitemap->addUrl(
    'https://www.domain.tld/my/page3.html',
    new DateTime('2015-03-09 18:01:00'),
    Sitemap::CHANGEFREQ_DAILY
);

$sitemap->addUrl(
    'https://www.domain.tld/my/page4.html',
    new DateTime('2015-03-09 18:02:00'),
    Sitemap::CHANGEFREQ_HOURLY,
    0.8
);

//file_put_contents(__DIR__ . '/sitemap.xml.gz', $sitemap->render());
file_put_contents(__DIR__ . '/sitemap.xml', $sitemap->render());
~~~

Sitemap index
~~~php
require 'path/to/vendor/autoload.php';

$index = new Euskadi31\Component\Sitemap\Writer\SitemapIndex();

//$index->setCompression(true);
//$index->setCompressionLevel(9);

$index->addSitemap('https://www.domain.tld/sitemap_product.xml');

$index->addSitemap(
    'https://www.domain.tld/sitemap.xml',
    new DateTime('2015-03-09 18:00:00')
);

//file_put_contents(__DIR__ . '/sitemap_index.xml.gz', $index->render());
file_put_contents(__DIR__ . '/sitemap_index.xml', $index->render());
~~~

License
-------

sitemap-php is licensed under [the MIT license](LICENSE.md).
