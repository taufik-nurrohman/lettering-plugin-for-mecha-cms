<?php

// It is difficult to use the conditional page types inside the plugin file
// as the conditional page types are declared inside the routes, while the
// routes are declared after all of the plugin files loaded.
if(strpos($config->url_current, $config->url . '/' . $config->manager->slug) !== 0) {

    // Text breaker ...
    function lettering_PHP($text) {
        $results = '<span class="word-1 char-group">';
        $skip = false;
        $entity_open = false;
        $entity_close = false;
        $index_word = 2;
        $index_letter = 1;
        $letters = str_split($text);
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
        return '<span aria-label="' . strip_tags($text) . '"><span aria-hidden="true" class="word-group">' . $results . '</span></span></span>';
    }

    // Text unbreaker ... (hacky, I know)
    function remove_lettering_PHP($text) {
        return preg_replace(array(
            '#<span aria-label=".*?">([^<]*)<\/span>#',
            '#<span aria-hidden="true" class="word-group">([^<]*)<\/span>#',
            '#<span class="word\-.*?">([^<]*)<\/span>#',
            '#<span class="char\-.*?">([^<]*)<\/span>#'
        ), '$1', $text);
    }

    Weapon::add('before_shield_config_redefine', function() {
        $article = Config::get('article');
        $page = Config::get('page');
        if(
            (isset($article->fields->break_title_text) && $article->fields->break_title_text !== false) ||
            (isset($page->fields->break_title_text) && $page->fields->break_title_text !== false)
        ) {
            // Break letters in article and page titles
            Filter::add('article:title', 'lettering_PHP');
            Filter::add('page:title', 'lettering_PHP');
            // Do not break letters in widgets
            Filter::add('widget:recent.post', 'remove_lettering_PHP');
            Filter::add('widget:random.post', 'remove_lettering_PHP');
            Filter::add('widget:related.post', 'remove_lettering_PHP');
            // Reset article and page data
            Config::set('article', isset($article->path) ? Get::article($article->path) : false);
            Config::set('page', isset($page->path) ? Get::page($page->path) : false);
        }
    });

}