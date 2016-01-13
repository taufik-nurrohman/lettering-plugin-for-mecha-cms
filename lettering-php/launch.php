<?php

// text breaker ...
function do_lettering($text) {
    $results = '<span class="word-1 char-group">';
    $skip = $entity_open = $entity_close = false;
    $index_word = 2;
    $index_char = 1;
    $letters = preg_split('#(?<!^)(?!$)#u', $text);
    foreach($letters as $letter) {
        $entity_open = $letter === '&';
        $entity_close = $letter === ';';
        if($letter === '<' || $entity_open) $skip = true;
        if($letter === '>' || $entity_close) $skip = false;
        if( ! $skip && $letter === ' ') {
            $results .= '</span> <span class="word-' . $index_word . ' char-group">';
            $index_word++;
        } else {
            if( ! $skip && $letter !== '<' && $letter !== '>' && $letter !== '&' && $letter !== ';' && $letter !== ' ') {
                $results .= '<span class="char-' . $index_char . '">' . $letter . '</span>';
                $index_char++;
            } else {
                if($entity_open) {
                    $results .= '<span class="char-' . $index_char . '">';
                }
                $results .= $letter;
                if($entity_close) {
                    $results .= '</span>';
                    $index_char++;
                }
            }
        }
    }
    return '<span aria-label="' . str_replace(array('"', '\''), array('&quot;', '&#039;'), trim(strip_tags($text))) . '"><span aria-hidden="true" class="clause-1 word-group">' . $results . '</span></span></span>';
}

if($config->is->post) {
    Filter::add('shield:lot', function($data) {
        $c = $config->page_type;
        if(isset($data[$c]->fields->break_title_text) && $data[$c]->fields->break_title_text !== false) {
            $data[$c]->title = do_lettering($data[$c]->title);
        }
        return $data;
    });
}