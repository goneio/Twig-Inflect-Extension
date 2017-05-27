<?php
namespace Gone\Tests;

use Gone\Twig\InflectExtension;
use PHPUnit\Framework\TestCase;

class InflectTest extends TestCase
{
    /** @var \Twig_Environment */
    private $twig;
    /** @var \Twig_LoaderInterface */
    private $loader;

    public function setUp()
    {
        parent::setUp();
        $this->loader = new \Twig_Loader_Array([]);
        $this->twig = new \Twig_Environment($this->loader);
        $this->twig->addExtension(new InflectExtension());
    }

    public function testNoop()
    {
        $this->twig->setLoader(new \Twig_Loader_Array([
            'testNoop'          => "{{ test_phrase }}",
        ]));
        $this->assertEquals("Test Words", $this->twig->render('testNoop', ['test_phrase' => 'Test Words']));
    }

    public function testPluralise()
    {
        $this->twig->setLoader(new \Twig_Loader_Array([
            'test'          => "{{ test_phrase|plural }}",
        ]));
        $this->assertEquals("hats", $this->twig->render('test', ['test_phrase' => 'hat']));
        $this->assertEquals("hats", $this->twig->render('test', ['test_phrase' => 'hats']));
    }

    public function testPluraliserOneInstance()
    {
        $this->twig->setLoader(new \Twig_Loader_Array([
            'test'          => "{{ test_phrase|plural(1) }}",
        ]));
        $this->assertEquals("1 hat", $this->twig->render('test', ['test_phrase' => 'hat']));
        $this->assertEquals("1 hat", $this->twig->render('test', ['test_phrase' => 'hats']));
    }

    public function testPluraliserTwoInstances()
    {
        $this->twig->setLoader(new \Twig_Loader_Array([
            'test'          => "{{ test_phrase|plural(2) }}",
        ]));
        $this->assertEquals("2 hats", $this->twig->render('test', ['test_phrase' => 'hat']));
        $this->assertEquals("2 hats", $this->twig->render('test', ['test_phrase' => 'hats']));
    }

    public function testSingularise()
    {
        $this->twig->setLoader(new \Twig_Loader_Array([
            'test'          => "{{ test_phrase|singular }}",
        ]));
        $this->assertEquals("hat", $this->twig->render('test', ['test_phrase' => 'hats']));
        $this->assertEquals("hat", $this->twig->render('test', ['test_phrase' => 'hat']));
    }

    public function testGetName()
    {
        $extension = new InflectExtension();
        $this->assertEquals("inflect_extension", $extension->getName());
    }
}
