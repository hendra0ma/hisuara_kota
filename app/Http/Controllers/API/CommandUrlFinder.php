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
        $data = [
            'action' => '',
            'target' => '',
            'hint' => '',
        ];
        
        $isCommandHasWordDari = strpos($command, 'dari');
        if ($isCommandHasWordDari) {
            $name = $this->getTextAfterWordDari($command);
            $data['action'] = 'click';
            $data['target'] = $name;
            $data['hint'] = "klik tombol verifikasi kiriman c1 dari $name(nav operator verifikasi c1)";

            return response()->json($data, 200);
        }

        $keys = array_keys($this->commandsAndUrls);
        $result = null;
        foreach ($keys as $key) {
            if (stripos($command, $key) !== false) {
                $result = $this->commandsAndUrls[$key];
                break;
            }
        }
        if ($result !== null) {
            $data['action'] = 'redirect';
            $data['target'] = $result;
            return response()->json($data, 200);
        }

        return response()->json($data, 200);
    }

    private function getTextAfterWordDari($text)
    {
        $pattern = '/\b(?:dari)\s+(.*)\b/';
        preg_match($pattern, $text, $matches);

        if (isset($matches[1])) {
            $wordsAfterDari = $matches[1];
            return $wordsAfterDari;
        } else {
            echo "Nama tidak terdeteksi";
        }
    }
}
