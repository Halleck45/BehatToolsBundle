<?php

namespace Hal\Bundle\BehatTools\Domain\Repository;

/*
 * This file is part of the Behat Tools
 * (c) 2012 Jean-François Lépine <jeanfrancois@lepine.pro>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Feature Manager
 *
 * @author Jean-François Lépine <jeanfrancois@lepine.pro>
 */
interface FeatureInterface
{

    public function getFeatures();

    public function getFeatureByPath($filename);

    public function factoryGherkinFeature($filename);
}