<?php

namespace App\Models;

class Url
{
    private $url;
    private $lastUpdate;
    private $frequency;
    private $priority;

    public static function create($url)
    {
        $newNode = new self();
        $newNode->url = url($url);

        return $newNode;
    }

    public function lastUpdate($lastUpdate)
    {
        $this->lastUpdate = $lastUpdate;

        return $this;
    }

    public function frequency($frequency)
    {
        $this->frequency = $frequency;

        return $this;
    }

    public function priority($priority)
    {
        $this->priority = $priority;
        
        return $this;
    }

    public function build()
    {
        return "<url>" .
          "<loc>$this->url</loc>" .
          "<lastmod>$this->lastUpdate</lastmod>" .
          "<changefreq>$this->frequency</changefreq>" .
          "<priority>$this->priority</priority>" .
          "</url>";
    }
}