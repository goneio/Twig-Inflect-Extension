<?php
namespace Gone\Twig;

use Gone\Inflection\Inflect;

class InflectExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            'singular' => new \Twig_SimpleFilter('singular', [$this, 'singularFilter']),
            'plural'   => new \Twig_SimpleFilter('plural', [$this, 'pluralFilter']),
        );
    }

    public function singularFilter($word)
    {
        return Inflect::singularize($word);
    }

    public function pluralFilter($word, $count = null)
    {
        if ($count) {
            return Inflect::pluralizeIf($count, $word);
        } else {
            return Inflect::pluralize($word);
        }
    }

    public function getName()
    {
        return 'inflect_extension';
    }
}
