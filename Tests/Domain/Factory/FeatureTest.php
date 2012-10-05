<?php

namespace Hal\Bundle\BehatTools\Tests;

use Hal\Bundle\BehatTools\Domain\Factory\Feature as FeatureFactory;

class FactoryFeatureTest extends \PHPUnit_Framework_TestCase
{

    private $factory;

    public function setUp()
    {


        $keywords = new \Behat\Gherkin\Keywords\ArrayKeywords(
                array(
                    'en' => array(
                        'feature' => 'Feature',
                        'background' => 'Background',
                        'scenario' => 'Scenario',
                        'scenario_outline' => 'Scenario Outline|Scenario Template',
                        'examples' => 'Examples|Scenarios',
                        'given' => 'Given',
                        'when' => 'When',
                        'then' => 'Then',
                        'and' => 'And',
                        'but' => 'But'
                    )
                )
        );
        $keywords->setLanguage('en');
        $lexer = $this->getMock('Behat\Gherkin\Lexer', null, array($keywords));
        $parser = $this->getMock('Behat\Gherkin\Parser', null, array($lexer));

        $report = $this->getMock('Hal\Bundle\BehatTools\Entity\ReportInterface');
        $repository = $this->getMock('Hal\Bundle\BehatTools\Domain\Repository\ReportInterface');
        $container = $this->getMock('\Symfony\Component\DependencyInjection\ContainerInterface');
        $repository
            ->expects($this->any())
            ->method('getReportByFeature')
            ->will($this->returnValue($report));
        $this->factory = new FeatureFactory($parser, $repository, $container);
    }

    public function testWeCanFactoryAFeatureProvidingItsFilename()
    {

        $filename = __DIR__ . '/../../resources/features/all-correct.feature';
        $feature = $this->factory->factory($filename);
        $this->assertInstanceOf('Hal\Bundle\BehatTools\Entity\FeatureInterface', $feature, 'We can factory a feature');
    }

    /**
     * @expectedException Hal\Bundle\BehatTools\Exception\Domain\Factory\NotBuildable
     */
    public function testWeCannotFactoryAnUnexistentFeature()
    {
        $filename = __DIR__ . 'unexistent.feature';
        $feature = $this->factory->factory($filename);
    }

}