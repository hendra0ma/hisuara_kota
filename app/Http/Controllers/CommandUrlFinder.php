<?php

namespace App\Http\Controllers;

class CommandUrlFinder
{
    private $commandsAndUrls;

    public function __construct()
    {
        $jsonFilePath = storage_path('commandsAndUrls.json');
        $jsonCommandsAndUrls = file_get_contents($jsonFilePath);

        $commandsAndUrlsArray = json_decode($jsonCommandsAndUrls, true);
        $this->commandsAndUrls = $commandsAndUrlsArray;
    }

    public function findUrlByCommand($command)
    {
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
