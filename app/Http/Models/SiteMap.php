<?php

namespace App\Models;

class SiteMap
{
    public const START_TAG = '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
    public const END_TAG = '</urlset>';

    // to build the XML content
    private $content;

    public function add(Url $siteMapUrl)
    {
        $this->content .= $siteMapUrl->build();
    }

    public function build()
    {
        return self::START_TAG . $this->content . self::END_TAG;
    }
}
