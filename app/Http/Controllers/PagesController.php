<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory as View;

class PagesController extends Controller
{

    private $view;

    public function __construct(
        View $view
    )
    {
        $this->view = $view;
    }

    /**
     * Displays homepage.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function getHome()
    {

        return $this->view
            ->make("home");
    }

    /**
     * Returns requested view from pages folder.
     *
     * @param string $url
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function getPage($url)
    {

        if (!$this->view->exists("pages." . $url)) {
            return $this->view->make("errors.404", [], [404]);
        }

        $pageTitle = str_replace("-", " ", $url);

        return $this->view
            ->make("pages/" . $url)
            ->with("pageTitle", $pageTitle);
    }

}
