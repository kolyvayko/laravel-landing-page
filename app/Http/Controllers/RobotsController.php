<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Routing\ResponseFactory as Response;

class RobotsController extends Controller
{

    private $response;

    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    /*
     * Returns robots.txt based on current environment to avoid indexing dev sites.
     *
     * @return Illuminate\Contracts\Routing\ResponseFactory
     *
     */
    public function getRobotsTxt()
    {
        $env = app()->environment();

        if ($env === "production") {
            return $this->response
                ->view("robots.production")
                ->header("Content-Type", "text/plain");
        } else {
            return $this->response
                ->view("robots.dev")
                ->header("Content-Type", "text/plain");
        }
    }

}
