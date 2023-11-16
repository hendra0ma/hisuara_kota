<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommandUrlFinder extends Controller
{
    private $commandsAndUrls;

    public function __construct()
    {
        $jsonFilePath = storage_path('commandsAndUrls.json');
        $jsonCommandsAndUrls = file_get_contents($jsonFilePath);

        $commandsAndUrlsArray = json_decode($jsonCommandsAndUrls, true);
        $this->commandsAndUrls = $commandsAndUrlsArray;
    }

    public function findUrlByCommand(Request $request)
    {
        $command = $request->input('text', 'default');
        $keys = array_keys($this->commandsAndUrls);
        $result = null;
        foreach ($keys as $key) {
            if (stripos($command, $key) !== false) {
                $result = $this->commandsAndUrls[$key];
                break;
            }
        }

        return $result;
    }
}
