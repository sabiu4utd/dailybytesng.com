<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use DateTime;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var list<string>
     */
    protected $helpers = [];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.
        $this->session = service('session');
    }
    protected function timeAgo($datetime)
    {
        // Normalize timestamps with microseconds
        $time = new DateTime(substr($datetime, 0, 19));
        $now = new DateTime();
        $diff = $now->getTimestamp() - $time->getTimestamp();

        if ($diff < 0) $diff = 0;

        $minutes = floor($diff / 60);
        $hours   = floor($diff / 3600);
        $days    = floor($diff / 86400);
        $months  = floor($diff / 2592000); // approx 30 days

        if ($minutes < 1) return "0 minutes";
        if ($minutes === 1) return "1m";
        if ($minutes < 60) return $minutes . "m";

        if ($hours === 1) return "1 hour ago";
        if ($hours < 24) return $hours . " hours ago";

        if ($days === 1) return "1 day ago";
        if ($days < 30) return $days . " days ago";

        if ($months === 1) return "1 month ago";
        return $months . " months ago";
    }
}
