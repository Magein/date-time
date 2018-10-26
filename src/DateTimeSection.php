<?php

namespace Magein\date;

class DateTimeSection
{
    /**
     * @var DateTimeAttr
     */
    private $dateTimeAttr = null;

    /**
     * DateTimeSection constructor.
     * @param DateTimeAttr|null $dateTimeAttr
     */
    public function __construct(DateTimeAttr $dateTimeAttr)
    {
        $this->dateTimeAttr = $dateTimeAttr;
    }

    /**
     * @return DateTimeAttr|null
     */
    public function getDateTimeAttr()
    {
        return $this->dateTimeAttr;
    }

    /**
     * @param int $day 正数往前 负数往后
     * @return BeginEndTime
     */
    public function day($day = 1)
    {
        $day = intval($day);

        $beginTime = strtotime(" -$day day", $this->dateTimeAttr->getDate());

        $endTime = $beginTime + 86400;

        return new BeginEndTime($beginTime, $endTime);
    }

    /**
     * @param int $day
     * @return BeginEndTime
     */
    public function betweenDay($day = 1)
    {
        $day = intval($day);

        $beginTime = strtotime(" -$day day", $this->dateTimeAttr->getDate());

        $endTime = strtotime($this->dateTimeAttr->getDate(false));

        return new BeginEndTime($beginTime, $endTime);
    }

    /**
     * @param int $week 正数往前 负数往后
     * @return BeginEndTime
     */
    public function week($week = 1)
    {
        $week = intval($week);

        // 计算这周的开始时间（也是上周的结束时间）
        $curWeek = $this->dateTimeAttr->getWeek(false);
        $curWeekBeginTime = $this->dateTimeAttr->getDate() - ($curWeek * 86400);

        // 前xx周得开始的时间
        $beginTime = strtotime(" -$week week", $curWeekBeginTime);
        // 加上7天得到结束的时间
        $endTime = $beginTime + 7 * 86400;

        return new BeginEndTime($beginTime, $endTime);
    }

    /**
     * @param int $week
     * @return BeginEndTime
     */
    public function betweenWeek($week = 1)
    {
        $week = intval($week);

        // 计算这周的开始时间（也是上周的结束时间）
        $curWeek = $this->dateTimeAttr->getWeek(false);
        $curWeekBeginTime = $this->dateTimeAttr->getDate() - ($curWeek * 86400);

        // 前xx周得开始的时间
        $beginTime = strtotime(" -$week week", $curWeekBeginTime);
        // 结束的时间就是这一周的开始时间
        $endTime = $curWeekBeginTime;

        return new BeginEndTime($beginTime, $endTime);
    }

    /**
     * @param $month
     * @return BeginEndTime
     */
    public function month($month)
    {
        $month = intval($month);

        $beginTime = strtotime(" -$month month",
            strtotime(
                $this->dateTimeAttr->getYear() . '-' . $this->dateTimeAttr->getMonth()
            )
        );

        $endTime = strtotime('+1 month', $beginTime);

        return new BeginEndTime($beginTime, $endTime);
    }

    /**
     * @param $month
     * @return BeginEndTime
     */
    public function betweenMonth($month)
    {
        $month = intval($month);

        $beginTime = strtotime(" -$month month",
            strtotime(
                $this->dateTimeAttr->getYear() . '-' . $this->dateTimeAttr->getMonth()
            )
        );

        $endTime = strtotime(
            $this->dateTimeAttr->getYear() . '-' . $this->dateTimeAttr->getMonth()
        );

        return new BeginEndTime($beginTime, $endTime);
    }
}