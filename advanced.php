<?php

$i = 1;
while (true) {
    $page_link = 'https://www.newhome.ch/de/kaufen/suchen/haus_wohnung/kanton_zuerich/liste.aspx?p=' . $i;
    $html = file_get_contents($page_link);
    if ($html) {
        $dom = new DOMDocument;
        @$dom->loadHTML($html);
        $links = $dom->getElementsByTagName('a');
        echo $i . ' - <a href="' . $page_link . '">' . $page_link . '</a><br><ol>';
        foreach ($links as $link) {

            $url = $link->getAttribute('href');
            parse_str($url, $parsed);
            if (isset($parsed['id'])) {
                if (filter_var($url, FILTER_VALIDATE_URL)) {
                    echo '<li><a target="_blank" href="' . $url . '">' . $url . '</a></li>';
                } else {
                    echo '<li><a target="_blank" href="https://www.homegate.ch' . $url . '">https://www.homegate.ch' . $url . '</a></li>';
                }
            }
        }
        echo "</ol>";
        $i++;
    } else {
        echo "pages count = $i";
        break;
    }
}
