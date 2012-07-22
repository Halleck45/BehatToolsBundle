<?php

namespace Hal\Bundle\BehatTools\Domain\Model\Feature\Dumper;

use Behat\Gherkin\Node\FeatureNode as FeatureNode,
    Hal\Bundle\BehatTools\Entity\FeatureInterface,
    Hal\Bundle\BehatTools\Entity\GherkinInterface,
    Hal\Bundle\BehatTools\Entity\ReportInterface;
use \Behat\Gherkin\Node\OutlineNode;
use Symfony\Component\Serializer\Serializer,
    Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer,
    Symfony\Component\Serializer\Encoder\JsonEncoder;

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
class Json extends DumperAbstract
{

    /**
     * Dump
     *
     * @return string
     */
    public function dump()
    {
        $gherkin = $this->feature->getGherkin();
        $description = array_pad(preg_split('!\n!', $gherkin->getDescription(), 4), 4, '');

        $result = array(
            'title' => $gherkin->getTitle()
            , 'notes' => $description[3]
            , 'inorder' => $description[0]
            , 'as' => $description[1]
            , 'should' => $description[2]
            , 'scenarios' => array()
        );

        //
        // Scenarios
        foreach ($gherkin->getScenarios() as $scenario) {
            $tmpScenario = array(
                'title' => $scenario->getTitle()
                , 'steps' => array()
                , 'isOutline' => ($scenario instanceof OutlineNode)
                , 'examples' => array()
            );
            if ($tmpScenario['isOutline']) {
                $tmpScenario['examples'] = $scenario->getExamples()->getRows();
            }

            //
            // Steps
            foreach ($scenario->getSteps() as $step) {
                $tmpStep = array(
                    'type' => $step->getType()
                    , 'text' => $step->getText()
                    , 'outline' => array()
                );

                $args = $step->getArguments();
                if (sizeof($args) > 0) {
                    $rows = $args[0]->getRows();
                    $tmpStep['outline'] = $rows;
                }

                array_push($tmpScenario['steps'], $tmpStep);
            }

            array_push($result['scenarios'], $tmpScenario);
        }

        $jsonEncoder = new JsonEncoder();
        return $jsonEncoder->encode($result, 'json');
    }

}