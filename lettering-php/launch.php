<?php

// It is difficult to use the conditional page types inside the plugin file
// as the conditional page types are declared inside the routes, while the
// routes are declared after all of the plugin files finished loaded.
//
// Update
// ------
// This problem already fixed in Mecha 1.1.3, but I will keep this
// conditional line remain intact to make this plugin compatible with the
// older version of Mecha.

if(strpos($config->url_current, $config->url . '/' . $config->manager->slug) !== 0) {

    // Text breaker ...
    function do_lettering_PHP($text) {
        $chars = array( // Common ...
            '&cent;' => '¢',
            '&euro;' => '€',
            '&pound;' => '£',
            '&yen;' => '¥',
            '&copy;' => '©',
            '&reg;' => '®',
            '&trade;' => '™',
            '&permil;' => '‰',
            '&micro;' => 'µ',
            '&middot;' => '·',
            '&bull;' => '•',
            '&hellip;' => '…',
            '&prime;' => '′',
            '&Prime;' => '″',
            '&sect;' => '§',
            '&para;' => '¶',
            '&szlig;' => 'ß',
            '&lsaquo;' => '‹',
            '&rsaquo;' => '›',
            '&laquo;' => '«',
            '&raquo;' => '»',
            '&lsquo;' => '‘',
            '&rsquo;' => '’',
            '&ldquo;' => '“',
            '&rdquo;' => '”',
            '&sbquo;' => '‚',
            '&bdquo;' => '„',
            '&le;' => '≤',
            '&ge;' => '≥',
            '&ndash;' => '–',
            '&mdash;' => '—',
            '&macr;' => '¯',
            '&oline;' => '‾',
            '&curren;' => '¤',
            '&brvbar;' => '¦',
            '&uml;' => '¨',
            '&iexcl;' => '¡',
            '&iquest;' => '¿',
            '&circ;' => 'ˆ',
            '&tilde;' => '˜',
            '&deg;' => '°',
            '&minus;' => '−',
            '&plusmn;' => '±',
            '&divide;' => '÷',
            '&frasl;' => '⁄',
            '&times;' => '×',
            '&sup1;' => '¹',
            '&sup2;' => '²',
            '&sup3;' => '³',
            '&frac14;' => '¼',
            '&frac12;' => '½',
            '&frac34;' => '¾',
            '&fnof;' => 'ƒ',
            '&int;' => '∫',
            '&sum;' => '∑',
            '&infin;' => '∞',
            '&radic;' => '√',
            '&asymp;' => '≈',
            '&ne;' => '≠',
            '&equiv;' => '≡',
            '&dagger;' => '†',
            '&Dagger;' => '‡',
            '&Agrave;' => 'À',
            '&Aacute;' => 'Á',
            '&Acirc;' => 'Â',
            '&Atilde;' => 'Ã',
            '&Auml;' => 'Ä',
            '&Aring;' => 'Å',
            '&AElig;' => 'Æ',
            '&Ccedil;' => 'Ç',
            '&Egrave;' => 'È',
            '&Eacute;' => 'É',
            '&Ecirc;' => 'Ê',
            '&Euml;' => 'Ë',
            '&Igrave;' => 'Ì',
            '&Iacute;' => 'Í',
            '&Icirc;' => 'Î',
            '&Iuml;' => 'Ï',
            '&ETH;' => 'Ð',
            '&Ntilde;' => 'Ñ',
            '&Ograve;' => 'Ò',
            '&Oacute;' => 'Ó',
            '&Ocirc;' => 'Ô',
            '&Otilde;' => 'Õ',
            '&Ouml;' => 'Ö',
            '&Oslash;' => 'Ø',
            '&OElig;' => 'Œ',
            '&Scaron;' => 'Š',
            '&Ugrave;' => 'Ù',
            '&Uacute;' => 'Ú',
            '&Ucirc;' => 'Û',
            '&Uuml;' => 'Ü',
            '&Yacute;' => 'Ý',
            '&Yuml;' => 'Ÿ',
            '&THORN;' => 'Þ',
            '&agrave;' => 'à',
            '&aacute;' => 'á',
            '&acirc;' => 'â',
            '&atilde;' => 'ã',
            '&auml;' => 'ä',
            '&aring;' => 'å',
            '&aelig;' => 'æ',
            '&ccedil;' => 'ç',
            '&egrave;' => 'è',
            '&eacute;' => 'é',
            '&ecirc;' => 'ê',
            '&euml;' => 'ë',
            '&igrave;' => 'ì',
            '&iacute;' => 'í',
            '&icirc;' => 'î',
            '&iuml;' => 'ï',
            '&eth;' => 'ð',
            '&ntilde;' => 'ñ',
            '&ograve;' => 'ò',
            '&oacute;' => 'ó',
            '&ocirc;' => 'ô',
            '&otilde;' => 'õ',
            '&ouml;' => 'ö',
            '&oslash;' => 'ø',
            '&oelig;' => 'œ',
            '&scaron;' => 'š',
            '&ugrave;' => 'ù',
            '&uacute;' => 'ú',
            '&ucirc;' => 'û',
            '&uuml;' => 'ü',
            '&yacute;' => 'ý',
            '&thorn;' => 'þ',
            '&yuml;' => 'ÿ',
            '&Alpha;' => 'Α',
            '&Beta;' => 'Β',
            '&Gamma;' => 'Γ',
            '&Delta;' => 'Δ',
            '&Epsilon;' => 'Ε',
            '&Zeta;' => 'Ζ',
            '&Eta;' => 'Η',
            '&Theta;' => 'Θ',
            '&Iota;' => 'Ι',
            '&Kappa;' => 'Κ',
            '&Lambda;' => 'Λ',
            '&Mu;' => 'Μ',
            '&Nu;' => 'Ν',
            '&Xi;' => 'Ξ',
            '&Omicron;' => 'Ο',
            '&Pi;' => 'Π',
            '&Rho;' => 'Ρ',
            '&Sigma;' => 'Σ',
            '&Tau;' => 'Τ',
            '&Upsilon;' => 'Υ',
            '&Phi;' => 'Φ',
            '&Chi;' => 'Χ',
            '&Psi;' => 'Ψ',
            '&Omega;' => 'Ω',
            '&alpha;' => 'α',
            '&beta;' => 'β',
            '&gamma;' => 'γ',
            '&delta;' => 'δ',
            '&epsilon;' => 'ε',
            '&zeta;' => 'ζ',
            '&eta;' => 'η',
            '&theta;' => 'θ',
            '&iota;' => 'ι',
            '&kappa;' => 'κ',
            '&lambda;' => 'λ',
            '&mu;' => 'μ',
            '&nu;' => 'ν',
            '&xi;' => 'ξ',
            '&omicron;' => 'ο',
            '&pi;' => 'π',
            '&rho;' => 'ρ',
            '&sigmaf;' => 'ς',
            '&sigma;' => 'σ',
            '&tau;' => 'τ',
            '&upsilon;' => 'υ',
            '&phi;' => 'φ',
            '&chi;' => 'χ',
            '&psi;' => 'ψ',
            '&omega;' => 'ω',
            '&loz;' => '◊',
            '&spades;' => '♠',
            '&clubs;' => '♣',
            '&hearts;' => '♥',
            '&diams;' => '♦'
        );
        $results = '<span class="word-1 char-group">';
        $skip = false;
        $entity_open = false;
        $entity_close = false;
        $index_word = 2;
        $index_letter = 1;
        $letters = str_split(str_replace(array_values($chars), array_keys($chars), $text));
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
    function do_remove_lettering_PHP($text) {
        return preg_replace_callback('#(<a .*?>)([\s\S]*?)(<\/a>)#', function($matches) {
            return $matches[1] . preg_replace('#<span +(aria-(hidden|label)="|class="(word-|char-)).*?>|<\/span>#', "", $matches[2]) . $matches[3];
        }, $text);
    }

    Weapon::add('before_shield_config_redefine', function() {
        $article = Config::get('article');
        $page = Config::get('page');
        if(
            (isset($article->fields->break_title_text) && $article->fields->break_title_text !== false) ||
            (isset($page->fields->break_title_text) && $page->fields->break_title_text !== false)
        ) {
            // Break letters in article and page titles
            Filter::add('article:title', 'do_lettering_PHP');
            Filter::add('page:title', 'do_lettering_PHP');
            // Do not break letters in widgets
            Filter::add('widget:recent.post', 'do_remove_lettering_PHP');
            Filter::add('widget:random.post', 'do_remove_lettering_PHP');
            Filter::add('widget:related.post', 'do_remove_lettering_PHP');
            // Reset article and page data
            Config::set('article', isset($article->path) ? Get::article($article->path) : false);
            Config::set('page', isset($page->path) ? Get::page($page->path) : false);
        }
    });

}