<?php

namespace Hal\Bundle\BehatTools\Tests;

use \Hal\Bundle\BehatTools\Domain\Repository\Feature as Repo_Feature;

class RespositoryFeatureTest extends \PHPUnit_Framework_TestCase
{

    private $repo;

    public function setUp()
    {
        $factory = $this->getMock('Hal\Bundle\BehatTools\Domain\Factory\FeatureInterface');
        $feature = $this->getMock('Hal\Bundle\BehatTools\Entity\FeatureInterface');
        $factory
            ->expects($this->any())
            ->method('factory')
            ->will($this->returnValue($feature));
        $folder = __DIR__ . '/../../Fixtures/features/';
        $this->repo = new Repo_Feature($folder, $factory);
    }

    public function testRepoFindsAllFeatures()
    {
        $features = $this->repo->getFeatures();
        $this->assertCount(3, $features, 'All features are found');
    }

    public function testRepoFindFeatureByItsPath()
    {
        $feature = $this->repo->getFeatureByPath('all-correct.feature');
        $this->assertNotNull($feature, 'Feature can be found by its path');
        $this->assertInstanceOf('Hal\Bundle\BehatTools\Entity\FeatureInterface', $feature, 'Feature can be found by its path');
    }

    public function testUnexistentFeatureIsNotFound()
    {
        $feature = $this->repo->getFeatureByPath('toto');
        $this->assertNull($feature, 'Unexistent feature is not found');
    }

}