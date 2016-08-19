<?php

namespace App\Helpers;

class SitemapHelper
{

    const PAGES_FOLDER = DIRECTORY_SEPARATOR . "resources" . DIRECTORY_SEPARATOR . "views" . DIRECTORY_SEPARATOR . "pages" . DIRECTORY_SEPARATOR;

    /**
     * Gets all pages to be processed in sitemap.
     *
     * @return array
     *
     * @throws \Exception
     */
    public function getAllPages() {

        $result = [];
        $full_path = base_path() . self::PAGES_FOLDER;

        if (!is_dir($full_path)) {
            throw new \Exception("Error finding pages folder to create sitemap.xml.");
        }

        $files = scandir($full_path);
        unset($files[0]);
        unset($files[1]);

        foreach ($files as $file) {
            $view = str_replace(".blade.php", "", $file);
            $result[] = $view;
        }

        return $result;
    }

}
