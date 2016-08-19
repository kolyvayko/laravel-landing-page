<?php

namespace App\Http\Controllers;

use App\Helpers\SitemapHelper;
use Illuminate\Contracts\Config\Repository as Config;
use Illuminate\Contracts\Routing\UrlGenerator as Url;
use Watson\Sitemap\Sitemap;

class SitemapController extends Controller
{
    private $config;
    private $excludedPages;
    private $sitemap;
    private $sitemapHelper;
    private $url;

    public function __construct(
        Config $config,
        Sitemap $sitemap,
        SitemapHelper $sitemapHelper,
        Url $url
    )
    {
        $this->config = $config;
        $this->sitemap = $sitemap;
        $this->sitemapHelper = $sitemapHelper;
        $this->url = $url;

        $this->excludedPages = $this->config->get("sitemap.excluded_pages");
    }

    /*
     * Generates sitemap.xml
     *
     * @return \Illuminate\Http\Response sitemap.xml file
     */
    public function getSitemapXml()
    {
        // tag to homepage
        $this->sitemap->addTag($this->url->to("/") . "/", null, "always", "1");

        // gather all pages from resources/views/pages and create respective tags
        $allPages = $this->sitemapHelper->getAllPages();

        foreach ($allPages as $page) {
            if (!in_array($page, $this->excludedPages)) {
                $this->sitemap->addTag($this->url->to($page), null, "always", "0.8");
            }
        }

        return $this->sitemap->render();
    }

}
