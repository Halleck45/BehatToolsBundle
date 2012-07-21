<?php

namespace Hal\Bundle\BehatTools\Model;

use Behat\Gherkin\Node\FeatureNode as FeatureNode,
    Hal\Bundle\BehatTools\Entity\FeatureInterface,
    Hal\Bundle\BehatTools\Entity\GherkinInterface,
    Hal\Bundle\BehatTools\Entity\ReportInterface;

/*
 * This file is part of the Behat Tools
 * (c) 2012 Jean-François Lépine <jeanfrancois@lepine.pro>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Represents a feature, with its state
 *
 * @author Jean-François Lépine <jeanfrancois@lepine.pro>
 */
class Feature implements FeatureInterface
{

    /**
     * Contains the feature node
     * 
     * @var FeatureNode 
     */
    protected $gherkinObject;

    /**
     * Infos about the state of the feature
     * @var ReportInterface
     */
    protected $report;

    /**
     * Constructor
     * 
     * @param FeatureNode $feature
     * @param Report $report
     */
    public function __construct(GherkinInterface $feature, GherkinInterface $report)
    {
        $this->gherkinObject = $feature;
        $this->report = $report;
    }

    /**
     * Get the state of a feature
     *
     * @return ReportInterface
     */
    public function getReport();

    /**
     * Get the current feature
     *
     * @return GherkinInterface
     */
    public function getGherkin();
}