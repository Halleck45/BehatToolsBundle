<?php

namespace Hal\Bundle\BehatTools\Domain\Model;

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
class Feature implements GherkinInterface
{

    /**
     * Feature node
     *
     * @var FeatureNode
     */
    private $featureNode;

    /**
     * Constructor
     *
     * @param FeatureNode $gherkin
     */
    public function __construct(FeatureNode $gherkin)
    {
        $this->featureNode = $gherkin;
    }

    /**
     * Get the feature node
     * 
     * @return FeatureNode
     */
    public function getFeatureNode()
    {
        return $this->featureNode;
    }

    /**
     * Proxy (magic)
     *
     * @param string $name
     * @param array $args
     * @return mixed
     */
    public function __call($name, $args)
    {
        return call_user_func_array(array($this->featureNode, $name), $args);
    }

}