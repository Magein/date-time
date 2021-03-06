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

    /**
     * 从近由远依次是
     *
     *   当天   显示：H：i
     *
     *   昨天   显示：  昨天 H：i
     *
     *   前天及以后 显示：星期x H：i
     *
     *   大于一周 显示：  x月x日 上午/下午 H：i
     *
     *   大于一年 显示:  x年x月x日 上午/下午 H：i
     *
     * @return string
     */
    public function getTimeAwayFromNow()
    {
        $unixTime = $this->dateTimeAttr->get();

        if ($unixTime) {

            $now = time();

            if ($unixTime > $now) {
                return date('Y-m-d H:i:s', $this->dateTimeAttr->get());
            }

            $toDayBeginTime = date('Y-m-d');

            $toDayBeginUnixTime = strtotime($toDayBeginTime);

            // 当天
            if ($unixTime >= $toDayBeginUnixTime) {
                return date('H:i', $unixTime);
            }

            // 昨天
            if ($unixTime < $toDayBeginUnixTime && $unixTime > $toDayBeginUnixTime - 86400) {
                return '昨天 ' . date('H:i', $unixTime);
            }

            // 跨周
            $toDayWeek = date('w');

            $week = $this->dateTimeAttr->getWeek(false);

            if ($toDayWeek - $week > 0 && $week) {
                return $this->dateTimeAttr->getWeek() . ' ' . date('H:i', $unixTime);
            }

            // 今年
            if (date('Y') == $this->dateTimeAttr->getYear()) {
                return date('m-d ' . $this->dateTimeAttr->getMeridian() . ' H:i:s', $unixTime);
            }

            // 跨年
            return date('Y-m-d ' . $this->dateTimeAttr->getMeridian() . ' H:i:s', $unixTime);
        }

        return '';
    }
}