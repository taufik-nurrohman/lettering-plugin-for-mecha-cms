<?php

if(strpos($config->url_path, $config->manager->slug . '/') !== 0) {

    // Text breaker ...
    function do_lettering_PHP($text) {
        $results = '<span class="word-1 char-group">';
        $skip = false;
        $entity_open = false;
        $entity_close = false;
        $index_word = 2;
        $index_letter = 1;
        $letters = preg_split('#(?<!^)(?!$)#u', $text);
        foreach($letters as $letter) {
            $entity_open = $letter == '&';
            $entity_close = $letter == ';';
            if($letter == '<' || $entity_open) $skip = true;
            if($letter == '>' || $entity_close) $skip = false;
            if( ! $skip && $letter == ' ') {
                $results .= '</span> <span class="word-' . $index_word . ' char-group">';
                $index_word++;
            } else {
                if( ! $skip && $letter != '<' && $letter != '>' && $letter != '&' && $letter != ';' && $letter != ' ') {
                    $results .= '<span class="char-' . $index_letter . '">' . $letter . '</span>';
                    $index_letter++;
                } else {
                    if($entity_open) {
                        $results .= '<span class="char-' . $index_letter . '">';
                    }
                    $results .= $letter;
                    if($entity_close) {
                        $results .= '</span>';
                        $index_letter++;
                    }
                }
            }
        }
        return '<span aria-label="' . str_replace(array('"', '\''), array('&quot;', '&#039;'), strip_tags($text)) . '"><span aria-hidden="true" class="word-group">' . $results . '</span></span></span>';
    }

    // Text unbreaker ... (hacky, I know)
    function do_remove_lettering_PHP($text) {
        if(strpos($text, '<span class="word-1 char-group">') === false) return $text;
        return preg_replace_callback('#(<a .*?>)([\s\S]*?)(<\/a>)#', function($matches) {
            return $matches[1] . preg_replace('#<span(>| .*?>)|<\/span>#', "", $matches[2]) . $matches[3];
        }, $text);
    }

    Filter::add('shield:lot', function($data) use($config) {
        if(isset($data[$config->page_type]->fields->break_title_text)) {
            $data[$config->page_type]->title = do_lettering_PHP($data[$config->page_type]->title);
        }
        // Do not break letters in widgets
        Filter::add('widget:recent.post', 'do_remove_lettering_PHP');
        Filter::add('widget:random.post', 'do_remove_lettering_PHP');
        Filter::add('widget:related.post', 'do_remove_lettering_PHP');
        return $data;
    });

}