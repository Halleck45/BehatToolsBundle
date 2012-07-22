<?php

namespace Hal\Bundle\BehatTools\Domain\Factory;

use Symfony\Component\Finder\Finder,
    Behat\Gherkin\Lexer,
    Behat\Gherkin\Parser,
    Behat\Gherkin\Keywords\KeywordsInterface;
use Hal\Bundle\BehatTools\Domain\Repository\ReportInterface as Repo_ReportInterface,
    Hal\Bundle\BehatTools\Domain\Repository\FeatureInterface as Repo_FeatureInterface,
    Hal\Bundle\BehatTools\Domain\Factory\FeatureInterface as Factory_FeatureInterface,
    Hal\Bundle\BehatTools\Entity\FeatureInterface,
    Hal\Bundle\BehatTools\Domain\Model\Feature as ModelFeature,
    Hal\Bundle\BehatTools\Domain\Model\Gherkin as ModelGherkin,
    Hal\Bundle\BehatTools\Exception\Domain\Factory\NotBuildable as NotBuildableException;

use Symfony\Component\DependencyInjection\ContainerInterface;

/*
 * This file is part of the Behat Tools
 * (c) 2012 Jean-François Lépine <jeanfrancois@lepine.pro>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Allows to factory a featureElement
 *
 * @author Jean-François Lépine <jeanfrancois@lepine.pro>
 */
class Feature implements Factory_FeatureInterface
{

    /**
     * Report manager
     *
     * @var Repo_FeatureInterface
     */
    private $reportRepository;

    /**
     * Feature manager
     *
     * @var Repo_FeatureInterface
     */
    private $featureRepository;

    /**
     * Keywords used by behat
     *
     * @var ContainerInterface
     */
    private $container;

    /**
     * Constructor
     *
     * @param string $testsFolder
     */
    public function __construct(Parser $parser, Repo_ReportInterface $reportManager, ContainerInterface $container)
    {
        $this->parser = $parser;
        $this->reportRepository = $reportManager;
        $this->container = $container;
    }

    /**
     * Factory a featureElement
     * 
     * @return FeatureInterface
     */
    public function factory($filename)
    {
        if (!file_exists($filename)) {
            throw new NotBuildableException(sprintf('File "%s" not found', $filename));
        }
        $feature = $this->parser->parse(file_get_contents($filename), $filename);
        $proxy = new ModelGherkin($feature);
        $report = $this->reportRepository->getReportByFeature($proxy);
        return new ModelFeature($proxy, $report, $this->container);
    }

}