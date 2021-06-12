<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 09/06/21
 * Time: 18:45
 */

namespace App\Http\Controllers;

use App\Services\GitService;

class GitController extends Controller
{
    /*
     * Display the name and repositories of the specified account
     */
    public function display(GitService $service)
    {
        return view('repository-display', [
            'name' => env('GIT_USERNAME'),
            'repositories' => $service->fetchRepositories()
        ]);
    }
}