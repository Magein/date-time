<?php

namespace Magein\date;

class DateTimeAttr
{
    /**
     * 日期格式
     * @var string
     */
    private $dateFormat = 'Y-m-d';

    /**
     * 日期 时间之间的分隔符
     * @var string
     */
    private $dateTimeDelimiter = ' ';

    /**
     * 时间格式
     * @var string
     */
    private $timeFormat = 'H:i:s';

    /**
     * unix时间
     * @var string
     */
    private $unixTime = '';

    /**
     * 年
     * @var string
     */
    private $year = '';

    /**
     * 是闰年
     * @var int 0 不是 1 是
     */
    private $leapYear = 0;

    /**
     * 月
     * @var string
     */
    private $month = '';

    /**
     * 日
     * @var string
     */
    private $day = '';

    /**
     * 一年中的第几天
     * @var int
     */
    private $dayOfYear = 0;

    /**
     * 月份中的最大天数
     * @var int
     */
    private $maxDay = 31;

    /**
     * 时
     * @var string
     */
    private $hour = '';

    /**
     * 分
     * @var string
     */
    private $minute = '';

    /**
     * 秒
     * @var string
     */
    private $second = '';

    /**
     * @var int
     */
    private $week = 0;

    /**
     * 一年中的第几周天
     * @var int
     */
    private $weekOfYear = 0;

    /**
     * 子午线 小写的 am or pm
     * @var string
     */
    private $meridian = '';

    /**
     * Date constructor.
     * @param string $dateTimeOrUnixTime
     */
    public function __construct($dateTimeOrUnixTime = '')
    {
        $this->init($dateTimeOrUnixTime);
    }

    /**
     * @param $dateTimeOrUnixTime
     * @return bool
     * @throws \Exception
     */
    private function init($dateTimeOrUnixTime)
    {
        $dateTimeOrUnixTime = $dateTimeOrUnixTime ? $dateTimeOrUnixTime : time();

        if ($dateTimeOrUnixTime) {

            // 纯数字组成的识别成时间戳
            $check = function ($unixTime) {
                return preg_match('/^[0-9]+$/', $unixTime);
            };

            if ($check($dateTimeOrUnixTime)) {
                $this->unixTime = $dateTimeOrUnixTime;
            } else {
                $unixTime = strtotime($dateTimeOrUnixTime);
                if ($unixTime && $check($unixTime)) {
                    $this->unixTime = $unixTime;
                } else {
                    throw new \Exception('时间点设置的不正确');
                }
            }

            list(
                $this->year,
                $this->month,
                $this->day,
                $this->dayOfYear,
                $this->maxDay,
                $this->hour,
                $this->minute,
                $this->second,
                $this->week,
                $this->weekOfYear,
                $this->leapYear,
                $this->meridian,
                ) = explode(' ', date('Y m d z t H i s N W L a', $this->unixTime));
        }

        return true;
    }

    /**
     * @param string $dateTimeOrUnixTime
     * @return $this
     */
    public function set($dateTimeOrUnixTime)
    {
        $this->init($dateTimeOrUnixTime);

        return $this;
    }

    /**
     * @param string $format
     * @return $this
     */
    public function setDateFormat($format)
    {
        $this->dateFormat = $format ? $format : $this->dateFormat;

        return $this;
    }

    /**
     * @param string $format
     * @return $this
     */
    public function setTimeFormat($format)
    {
        $this->timeFormat = $format ? $format : $this->timeFormat;

        return $this;
    }

    /**
     * @param string $delimiter
     * @return $this
     */
    public function setDateTimeDelimiter($delimiter)
    {
        $this->dateTimeDelimiter = $delimiter ? $delimiter : $this->dateTimeDelimiter;

        return $this;
    }

    /**
     * @param bool $unixTime
     * @return false|string
     */
    public function get($unixTime = true)
    {
        if (empty($this->unixTime)) {
            return '';
        }

        if ($unixTime) {
            return $this->unixTime;
        }

        return date($this->dateFormat . $this->dateTimeDelimiter . $this->timeFormat, $this->unixTime);
    }

    /**
     * @param bool $unixTime
     * @return false|int|string
     */
    public function getDate($unixTime = true)
    {
        $date = date($this->dateFormat, $this->unixTime);

        if ($unixTime) {
            return strtotime($date);
        }

        return $date;
    }

    /**
     * @param bool $unixTime
     * @return false|int|string
     */
    public function getTime($unixTime = true)
    {
        $time = date($this->timeFormat, $this->unixTime);

        if ($unixTime) {
            return strtotime($time);
        }

        return $time;
    }

    /**
     * @return string
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @return int
     */
    public function getLeapYear()
    {
        return $this->leapYear;
    }

    /**
     * @return string
     */
    public function getMonth()
    {
        return $this->month;
    }

    /**
     * @return string
     */
    public function getDay()
    {
        return $this->day;
    }

    /**
     * @return int
     */
    public function getDayOfYear()
    {
        return $this->dayOfYear;
    }

    /**
     * @return int
     */
    public function getMaxDay()
    {
        return $this->maxDay;
    }

    /**
     * @return string
     */
    public function getHour()
    {
        return $this->hour;
    }

    /**
     * @return string
     */
    public function getMinute()
    {
        return $this->minute;
    }

    /**
     * @return string
     */
    public function getSecond()
    {
        return $this->second;
    }

    /**
     * @param bool $trans
     * @param string $prev
     * @return int|string
     */
    public function getWeek($trans = true, $prev = '星期')
    {
        if ($trans) {
            switch ($this->week) {
                case 7:
                    $week = '日';
                    break;
                case 1:
                    $week = '一';
                    break;
                case 2:
                    $week = '二';
                    break;
                case 3:
                    $week = '三';
                    break;
                case 4:
                    $week = '四';
                    break;
                case 5:
                    $week = '五';
                    break;
                case 6:
                    $week = '六';
                    break;
                default:
                    $week = '';
            }

            return $prev . $week;
        }
        return $this->week;
    }

    /**
     * @return int
     */
    public function getWeekOfYear()
    {
        return $this->weekOfYear;
    }

    /**
     * @param bool $trans
     * @return string
     */
    public function getMeridian($trans = true)
    {
        if ($trans) {
            return $this->meridian == 'am' ? '上午' : '下午';
        }

        return $this->meridian;
    }
}