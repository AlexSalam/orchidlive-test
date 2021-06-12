<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 09/06/21
 * Time: 18:52
 */

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;

class GitService
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @var string
     */
    protected $username;

    /**
     * GitService constructor.
     */
    public function __construct()
    {
        $username = env('GIT_USERNAME');

        if (!empty($username)) {
            $this->username = $username;
        } else {
            throw new \Exception('Username configuration value not set.');
        }

        $this->client = new Client([
            'base_uri' => 'https://api.github.com'
        ]);
    }

    /**
     * Fetch all public repositories for the configured git username
     *
     * @return array
     */
    public function fetchRepositories()
    {
        try {
            $repositories = $this->client->get("/users/{$this->username}/repos");
        } catch (GuzzleException $e) {
            session()->flash('error', 'There was an error communicating with Github, please refresh to try again.');
            Log::error($e->getMessage());
            return [];
        }
        return json_decode($repositories->getBody()->getContents());
    }
}