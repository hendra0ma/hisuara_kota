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
            'type' => '',
            'target' => '',
            'hint' => '',
        ];

        $spesificWordForClickButton = 'verifikasi';
        $spesificWordForRedirect = 'buka';
        $isCommandHasSpesificWordForClickButton = strpos($command, $spesificWordForClickButton);
        if ($isCommandHasSpesificWordForClickButton) {
            $name = $this->getTextAfterSpesificWord($spesificWordForClickButton, $command);

            $data['type'] = 'action';
            $data['target'] = $name;
            $data['hint'] = "klik tombol verifikasi kiriman c1 dari $name(nav operator verifikasi c1)";

            return response()->json($data, 200);
        }

        $spesificWordForRedirect = 'buka';
        $isCommandHasSpesificWordForRedirect = strpos($command, $spesificWordForRedirect);
        if ($isCommandHasSpesificWordForRedirect !== false) {
            $keys = array_keys($this->commandsAndUrls);
            $result = null;
            foreach ($keys as $key) {
                if (stripos($command, $key) !== false) {
                    $result = $this->commandsAndUrls[$key];
                    break;
                }
            }
            if ($result !== null) {
                $data['type'] = 'redirect';
                $data['target'] = $result;
                return response()->json($data, 200);
            }
        }

        $spesificWordForCount = 'berapa jumlah';
        $isCommandHasSpesificWordForCount = strpos($command, $spesificWordForCount);
        if ($isCommandHasSpesificWordForCount !== false) {
            $target = $this->getTextAfterSpesificWord($spesificWordForCount, $command);
            $data['type'] = 'count';
            $data['target'] = $target;
            $data['hint'] = "hitung jumlah $target";

            return response()->json($data, 200);
        }

        return response()->json($data, 200);
    }

    private function getTextAfterSpesificWord($specificWord, $text)
    {
        $pattern = "/\b(?:$specificWord)\s+(.*)\b/";
        preg_match($pattern, $text, $matches);

        if (isset($matches[1])) {
            $wordsAfterDari = $matches[1];
            return $wordsAfterDari;
        } else {
            echo "Nama tidak terdeteksi";
        }
    }
}
