<?php

namespace Hal\Bundle\BehatTools\Domain\Factory;

use Symfony\Component\Finder\Finder,
    Behat\Gherkin\Lexer,
    Behat\Gherkin\Parser;
use Hal\Bundle\BehatTools\Domain\Repository\FeatureInterface as Repo_FeatureInterface,
    Hal\Bundle\BehatTools\Entity\FeatureInterface,
    Hal\BehatWizardBundle\Domain\Model\Feature;

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
class Factory implements FactoryInterface
{

    /**
     * Report manager
     *
     * @var Repo_FeatureInterface
     */
    private $reportRepository;

    /**
     * Gherkin parser
     *
     * @var Behat\Gherkin\Parser
     */
    private $parser;

    /**
     * Constructor
     *
     * @param string $testsFolder
     */
    public function __construct(Parser $parser, Repo_FeatureInterface $reportManager)
    {
        $this->parser = $parser;
        $this->reportRepository= $reportManager;
    }

    /**
     * Factory a featureElement
     * 
     * @return FeatureElementInterface
     */
    public function factory($filename)
    {
        $feature = $this->parser->parse(file_get_contents($filename), $filename);
        $report = $this->reportRepository->getReportByFeature($feature);
        return new Feature($feature, $report);
    }

}