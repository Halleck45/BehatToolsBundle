<?php

namespace Hal\BehatWizardBundle\Manager\Behat\Feature;

/*
 * This file is part of the Behat Wizard
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
interface FactoryInterface
{
    /**
     * Factory a featureElement
     * 
     * @return ElementInterface
     */
    public function factory($filename) ;
}