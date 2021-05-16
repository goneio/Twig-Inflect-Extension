<?php
namespace MatthewBaggett\Twig;

use MatthewBaggett\Inflection\Inflect;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class InflectExtension extends AbstractExtension
{
    public function getFilters()
    {
        return array(
            'singular' => new TwigFilter('singular', [$this, 'singularFilter']),
            'plural'   => new TwigFilter('plural', [$this, 'pluralFilter']),
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
