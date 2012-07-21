<?php

namespace Hal\Bundle\BehatTools\Domain\Repository;

use Symfony\Component\Finder\Finder,
    FeatureInterface as Repo_FeatureInterface,
    Hal\Bundle\BehatTools\Domain\Factory\FeatureInterface as FeatureFactoryInterface,
    Hal\Bundle\BehatTools\Entity\FeatureInterface;

/*
 * This file is part of the Behat Tools
 * (c) 2012 Jean-François Lépine <jeanfrancois@lepine.pro>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Report Manager
 *
 * @author Jean-François Lépine <jeanfrancois@lepine.pro>
 */
class Feature implements Repo_FeatureInterface
{

    /**
     * features path
     *
     * @var string
     */
    private $folder;

    /**
     * Feature factory
     *
     * @var FeatureFactoryInterface
     */
    private $featureFactory;

    /**
     * Constructor
     *
     * @param string $testsFolder
     */
    public function __construct($testsFolder, FeatureFactoryInterface $featureFactory)
    {
        $this->folder = (string) rtrim($testsFolder, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
        $this->featureFactory = $featureFactory;
    }

    /**
     * Get features
     *
     * @return array
     */
    public function getFeatures()
    {
        $finder = new Finder();
        $finder->files()->in($this->folder)->name('*.feature');
        $features = array();

        foreach ($finder as $file) {
            $filename = $file->getRelativePathname();
            $node = $this->factoryFeature($file->getRealpath());
            array_push($features, $node);
        }

        return $features;
    }

    /**
     * get feature by its path
     *
     * @param string $filename
     * @return null|Behat\Gherkin\Node\FeatureNode
     */
    public function getFeatureByPath($filename)
    {
        $finder = new Finder();
        $finder->files()->in($this->folder . dirname($filename))->name(basename($filename));
        foreach ($finder as $file) {
            return $this->factoryFeature($file->getRealpath());
        }
        return null;
    }

    /**
     * Factory a gherkin node
     *
     * @param string $filename
     * @return FeatureElementInterface
     */
    public function factoryFeature($filename)
    {
        return $this->featureFactory->factory($filename);
    }

    /**
     * Get the relative path of the given feature
     *
     * @param FeatureNode $node
     * @return type
     */
    public function getRelativePath(FeatureInterface $node)
    {
        return str_replace($this->folder, '', $node->getFile());
    }

}