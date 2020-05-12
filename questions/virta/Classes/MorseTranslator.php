<?php

namespace Virta\Classes;

/**
 * Class Morse
 */
Class MorseTranslator
{
    /**
     * Morse table
     *
     * @var array
     */
    private $data = [
        ".-"=> "A",
         "-..." => "B",
        "-.-." => "C",
        "-.." => "D",
        "." => "E",
         "..-." => "F",
         "--." => "G",
        "...." => "H",
        ".." => "I",
        ".---" => "J",
        "-.-" => "K",
        ".-.." => "L",
        "--" => "M",
        "-." => "N",
        "---" => "O",
        ".--." => "P",
        "--.-" => "Q",
        ".-." => "R",
        "..." => "S",
        "-" => "T",
        "..-" => "U" ,
        "...-" => "V" ,
        ".--" => "W",
        "-..-" => "X",
        "-.--" => "Y",
        "--.." => "Z"
    ];

    /**
     * @param string $signal
     * @return string
     */
    public function decode_morse(string $signal): string
    {
        $rustart = getrusage ();
        return strtr(trim($signal), $this->data + ["  " => " ", " " => ""]);
    }

    /**
     * @param string $signal
     * @return string
     */
    public function translateToEnglish2(string $signal): string
    {
        $translation = "";
        $morse = "";
        $trimedSignal = trim($signal);
        $len = strlen ($trimedSignal);
        for ($i=0; $i < $len; $i++) {
            $morse .= $trimedSignal[$i];
            if (substr($morse, -1, 1) == ' ' && substr ($morse, 0,1) !== ' ') {
                $translation .= array_search (trim($morse),$this->data );
                $morse = "";
            }elseif (substr($morse, 0, 1) !== ' ' && ($i == $len - 1 )) {
                $translation .= array_search (trim($morse),$this->data );
                $morse = "";
            }elseif ((substr($morse, 0, 1) == ' ') && (substr($morse, 1, 2) == ' ')){
                $translation .= " ";
                $morse = "";
            }elseif ((substr($morse, 0, 1) != ' ') && (substr($morse, 0, 3) == '   ')){
                $translation .= array_search (trim($morse),$this->data );
                $morse = "";
            }
        }
        return strtoupper ($translation);
    }

    function possibilities($signals)
    {
        $data = [
            ".-" => "A",
            "-.-." => "C",
            "-.." => "D",
            "." => "E",
            "..-." => "F",
            "--." => "G",
            "...." => "H",
            ".." => "I",
            ".---" => "J",
            "-.-" => "K",
            ".-.." => "L",
            "--" => "M",
            "-." => "N",
            "---" => "O",
            ".--." => "P",
            "--.-" => "Q",
            ".-." => "R",
            "..." => "S",
            "-" => "T",
            "..-" => "U",
            "...-" => "V",
            ".--" => "W",
            "-..-" => "X",
            "-.--" => "Y",
            "--.." => "Z"
        ];
        $translation = [];
        if (preg_match ("/(\?)(.*)/", $signals) === 1) {
            if (!isset($data[$signals])) {
                preg_match_all ('/\?/', $signals, $matches);
                if (count ($matches[0]) > 0) {
                    for ($i = 0; $i < count ($matches); $i++) {
                        $dot = str_replace ("?", ".", $signals);
                        $dash = str_replace ("?", "-", $signals);
                        $changedSignals[$i]["dot"] = $dot;
                        $changedSignals[$i]["dash"] = $dash;
                    }
                    for ($i = 0; $i < count ($changedSignals); $i++) {
                        $translation = [$data[$changedSignals[$i]['dot']], $data[$changedSignals[$i]['dash']]];
                    }
                    return $translation;
                }
            }
        }
        else {
            return [$data[$signals]];
        }
    }

}

