<?php


namespace Virta\Classes;


class MarkDownPaser
{
    public function format(string $text)
    {
        $rules = array(
            '/^(?!(\*\s)|(#)).*/' => 'p',
            '/^\*\s(.*)/' => 'li',
            "/(^#{1,6})(.*)/" => "h"
        );
        foreach ($rules as $rule => $replacement) {
            $matched = preg_match ($rule, $text);
            if (!empty($matched)) {
                return $parsed = preg_replace_callback ($rule, function ($output) use ($replacement, $rule) {
                    if ($replacement === "h") {
                        $strongHeading = preg_match ('/^(\*{2})([\w].*?)(\*{2})$/', trim ($output[2]), $strongHeaderOutPut);
                        if ($strongHeading === 0) {
                            //multiple or single nested strong
                            $strongFound = preg_match_all ('/(\*{2})(\w.*?)(\*{2})/', trim ($output[2]), $out);
                            if ($strongFound !== 0) {
                                $multipleStrongWords = preg_replace ('/(\*{2})(\w.*?)(\*{2})/', '< strong>${2}< /strong>', $output[2]);
                                return "< h1>" . trim ($multipleStrongWords) . "< /h1>";
                            } else {
                                if ($output[1] === "#") {
                                    return "< h1>" . trim ($output[2]) . "< /h1>";
                                } elseif ($output[1] === "##") {
                                    return "< h2>" . trim ($output[2]) . "< /h2>";
                                } elseif ($output[1] === "###") {
                                    return "< h3>" . trim ($output[2]) . "< /h3>";
                                } elseif ($output[1] === "####") {
                                    return "< h4>" . trim ($output[2]) . "< /h4>";
                                } elseif ($output[1] === "#####") {
                                    return "< h5>" . trim ($output[2]) . "< /h5>";
                                } elseif ($output[1] === "######") {
                                    return "< h6>" . trim ($output[2]) . "< /h6>";
                                }
                            }
                        } elseif ($strongHeading === 1) {
                            return "< h1>< strong>" . trim ($strongHeaderOutPut[2]) . "< /strong>< /h1>";
                        }
                    } elseif ($replacement === "p") {
                        //multiple or single nested strong
                        $strongFound = preg_match_all ('/(\*{2})(\w.*?)(\*{2})/', $output[0], $out);
                        if ($strongFound !== 0) {
                            $multipleStrongWords = preg_replace ('/(\*{2})(\w.*?)(\*{2})/', '< strong>${2}< /strong>', $output[0]);
                            return "< p>" . trim ($multipleStrongWords) . "< /p>";
                        }
                        $compoundAsterisks = preg_match_all ("/(\*{2})(\*.*?)(\*{2})/", $output[0], $out);
                        if ($compoundAsterisks !== 0) {
                            $multipleStrongWords = preg_replace ('/(\*{2})(\*.*?)(\*{2})/', '< strong>${2}< /strong>', $output[0]);
                            return "< p>" . trim ($multipleStrongWords) . "< /p>";
                        }
                        return "< p>" . trim ($output[0]) . "< /p>";
                    } elseif ($replacement === "li") {
                        //multiple or single nested strong
                        $strongFound = preg_match_all ('/(\*{2})(\w.*?)(\*{2})/', $output[1], $out);
                        if ($strongFound !== 0) {
                            $multipleStrongWords = preg_replace ('/(\*{2})(\w.*?)(\*{2})/', '< strong>${2}< /strong>', $output[1]);
                            return "< li>" . ( $multipleStrongWords ) . "< /li>";
                        }
                        $compoundAsterisks = preg_match_all ("/(\*{2})(.*?\s)(\*{2})/", $output[1], $out);
                        if ($compoundAsterisks !== 0) {
                            $multipleStrongWords = preg_replace ('/(\*{2})(.*?\s)(\*{2})/', '< strong>${2}< /strong>', $output[1]);
                            return "< li>" . trim ($multipleStrongWords) . "< /li>";
                        }
                        return "< li>" . trim ($output[1]) . "< /li>";
                    }
                }, $text);
            }
        }
    }

    /**
     * @param $markdown
     * @return string|string[]|null
     */
    function markdown_parser ($markdown) {

        $rules = array(
            "/(^#{1}\s+)(.*)/" => "<h1>$2</h1>",
            "/(^#{2}\s+)(.*)/" => "<h2>$2</h2>",
            "/(^#{3}\s+)(.*)/" => "<h3>$2</h3>",
            "/(^#{4}\s+)(.*)/" => "<h4>$2</h4>",
            "/(^#{5}\s+)(.*)/" => "<h5>$2</h5>",
            "/(^#{6}\s+)(.*)/" => "<h6>$2</h6>",
            "/(^#{7,}\s+)(.*)/" => "$0",
            "/(^#)(.*)/" => "$0",
            "/^(?!(#)).*/" => "$0"

        );
        $trimmed = trim($markdown, ' ');
        foreach ($rules as $rule => $replacement) {
            $macthed = preg_match ($rule,$trimmed );
            if($macthed === 1){
                return preg_replace ($rule, $replacement, $trimmed);
            }
        }
    }
}
