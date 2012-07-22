<?php

namespace Hal\Bundle\BehatTools\Domain\Model\Feature\Dumper;

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
 * Get a representation a feature
 *
 * @author Jean-François Lépine <jeanfrancois@lepine.pro>
 */
abstract class DumperAbstract implements DumperInterface
{

    /**
     * Feature
     *
     * @var FeatureInterface
     */
    protected $feature;

    /**
     * Constructor
     *
     * @param FeatureInterface $feature
     */
    public function __construct(FeatureInterface $feature)
    {
        $this->feature = $feature;
    }

}