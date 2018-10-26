<?php

namespace Magein\date;

class BeginEndTime
{
    /**
     * 开始时间
     * @var string
     */
    private $beginTime = '';

    /**
     * 结束时间
     * @var string
     */
    private $endTime = '';

    /**
     * BeginEndTime constructor.
     * @param $beginUnixTime
     * @param $endUnixTime
     */
    public function __construct($beginUnixTime, $endUnixTime)
    {
        $this->beginTime = $beginUnixTime;
        $this->endTime = $endUnixTime;
    }

    /**
     * @return string
     */
    public function getBeginTimeFormat()
    {
        return date('Y-m-d H:i:s', $this->beginTime);
    }

    /**
     * @return string
     */
    public function getBeginTime()
    {
        return $this->beginTime;
    }

    /**
     * @return string
     */
    public function getEndTimeFormat()
    {
        return date('Y-m-d H:i:s', $this->endTime);
    }

    /**
     * @return string
     */
    public function getEndTime()
    {
        return $this->beginTime;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            $this->beginTime,
            $this->endTime
        ];
    }

    /**
     * @return string
     */
    public function toString()
    {
        return $this->beginTime . ',' . $this->endTime;
    }
}