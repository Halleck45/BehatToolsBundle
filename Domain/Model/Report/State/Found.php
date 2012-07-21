<?php

namespace Hal\Bundle\BehatTools\Domain\Model\Report\State;

/*
 * This file is part of the Behat Tools
 * (c) 2012 Jean-François Lépine <jeanfrancois@lepine.pro>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * State of a reports : found
 *
 * @author Jean-François Lépine <jeanfrancois@lepine.pro>
 */
class Found implements StateInterface
{

    /**
     * Content of the report
     *
     * @var string
     */
    private $reportContent;

    /**
     * XML Element
     *
     * @var \SimpleXMLElement
     */
    private $xml;

    /**
     * Constructor
     *
     * @param string $reportContent
     */
    public function __construct($reportContent)
    {
        $this->reportContent = (string) $reportContent;
        $this->xml = new \SimpleXMLElement($this->reportContent);
    }

    /**
     * Get content of the report file
     *
     * @return null|string
     */
    public function getFile()
    {
        return (string) $this->xml['file'];
    }

    /**
     * Get content of the report file
     *
     * @return null|string
     */
    public function getReportContent()
    {
        return $this->reportContent;
    }

    /**
     * Count errors
     *
     * @return null|integer
     */
    public function countErrors()
    {
        return (int) $this->xml['errors'];
    }

    /**
     * Count failures
     *
     * @return null|integer
     */
    public function countFailures()
    {
        return (int) $this->xml['failures'];
    }

    /**
     * Count tests
     *
     * @return null|integer
     */
    public function countTests()
    {
        return (int) $this->xml['tests'];
    }

    /**
     * Get duration
     *
     * @return null|float
     */
    public function getDuration()
    {
        return (int) $this->xml['durations'];
    }

    /**
     * List all tests cases
     *
     * @return array|SimpleXMLElement
     */
    public function listTestCases()
    {
        return $this->xml;
    }

}