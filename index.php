<?php

date_default_timezone_set('PRC');

spl_autoload_register(function ($class) {

    $classUrl = explode('\\', $class);

    include './src/' . end($classUrl) . '.php';
});

use Magein\date\DateTimeSection;
use Magein\date\DateTimeAttr;

$dateTime = '2017/10/21 08:25:55';
# 如果不传递参数，则使用当前时间戳
$dateTimeAttr = new DateTimeAttr($dateTime);
# 获取年
$dateTimeAttr->getYear();
# 获取月
$dateTimeAttr->getMonth();
# 获取日
$dateTimeAttr->getDay();
# 获取月的最大天数
$dateTimeAttr->getMaxDay();
# 获取一年中的第几天
$dateTimeAttr->getDayOfYear();
# 是否是润年 0 不是 1 是
$dateTimeAttr->getLeapYear();
# 获取子午线 am/上午 pm/下午
$dateTimeAttr->getMeridian();
# 获取时间  年月日 或者 年月日的时间戳（默认）
$dateTimeAttr->getDate();
# 获取时间  时分秒 或者 时分秒的时间戳（默认）
$dateTimeAttr->getTime();
# 获取时间  年月日时分秒 或者 年月日年月日时分秒的时间戳（默认）
$dateTimeAttr->get();
# 获取星期几 1-7 或者 星期一，星期二，周一，周二
$dateTimeAttr->getWeek();
# 获取一年中的第几周
$dateTimeAttr->getWeekOfYear();


$dateTimeSection = new DateTimeSection($dateTimeAttr);
# 获取两天前的时间段 2
# 得到的是一个 BeginEndTime 的对象
$beginEndTime = $dateTimeSection->day(2);

# 两天前的开始时间，获取到的是时间戳
$beginEndTime->getBeginTime();
# 两天前的结束时间，获取到的是时间戳
$beginEndTime->getEndTime();

# 获取 前两天
# 得到的是一个 BeginEndTime 的对象
$beginEndTime = $dateTimeSection->betweenDay(2);

# 两周前、前两周
$beginEndTime = $dateTimeSection->week(2);
$beginEndTime = $dateTimeSection->betweenWeek(2);

# 两月前、前两月
$beginEndTime = $dateTimeSection->month(2);
$beginEndTime = $dateTimeSection->betweenMonth(2);

# 根据时间段显示不同的时间格式
# 当天  H：i
# 昨天  昨天 H：i
# 前天及以后 星期几 H：i
# 大于一周 x月x日 上午/下午 H：i
# 大于一年 x年x月x日 上午/下午 H：i
$dateTimeFormat = $dateTimeSection->getTimeAwayFromNow();
echo $dateTimeFormat;

echo '<br>';
echo '<br>';

echo '*****************以下时间段是以设置的时间点为基准的**************************';
echo '<br>';
echo '<br>';

echo '当前时间是: ' . date('Y-m-d H:i:s');
echo '<br>';
echo '设置的时间点是:' . $dateTimeAttr->get(false);
echo '<br>';

$day = function ($day) use ($dateTimeSection) {
    $day = $dateTimeSection->day($day);
    echo $day->getBeginTimeFormat() . ' ~ ' . $day->getEndTimeFormat();
};
echo '一天前：';
echo $day(1);
echo '<br>';
echo '两天前：';
echo $day(2);
echo '<br>';
echo '四十天前：';
echo $day(40);

echo '<br>';
echo '<br>';

$betweenDay = function ($day) use ($dateTimeSection) {
    $betweenDay = $dateTimeSection->betweenDay($day);
    echo $betweenDay->getBeginTimeFormat() . ' ~ ' . $betweenDay->getEndTimeFormat();
};
echo '前一天：';
echo $betweenDay(1);
echo '<br>';
echo '前两天：';
echo $betweenDay(2);
echo '<br>';
echo '前三天：';
echo $betweenDay(3);
echo '<br>';
echo '前四十天：';
echo $betweenDay(40);

echo '<br>';
echo '<br>';

$week = function ($day) use ($dateTimeSection) {
    $week = $dateTimeSection->week($day);
    echo $week->getBeginTimeFormat() . ' ~ ' . $week->getEndTimeFormat();
};
echo '一周前：';
echo $week(1);
echo '<br>';
echo '两周前：';
echo $week(2);
echo '<br>';
echo '三周前：';
echo $week(3);
echo '<br>';
echo '八周前：';
echo $week(8);

echo '<br>';
echo '<br>';

$betweenWeek = function ($day) use ($dateTimeSection) {
    $betweenWeek = $dateTimeSection->betweenWeek($day);
    echo $betweenWeek->getBeginTimeFormat() . ' ~ ' . $betweenWeek->getEndTimeFormat();
};
echo '前一周：';
echo $betweenWeek(1);
echo '<br>';
echo '前两周：';
echo $betweenWeek(2);
echo '<br>';
echo '前三周：';
echo $betweenWeek(3);
echo '<br>';
echo '前八周：';
echo $betweenWeek(8);

echo '<br>';
echo '<br>';

$month = function ($day) use ($dateTimeSection) {
    $month = $dateTimeSection->month($day);
    echo $month->getBeginTimeFormat() . ' ~ ' . $month->getEndTimeFormat();
};
echo '一月前：';
echo $month(1);
echo '<br>';
echo '两个月前：';
echo $month(2);
echo '<br>';
echo '三个月前：';
echo $month(3);
echo '<br>';
echo '八个月前：';
echo $month(8);

echo '<br>';
echo '<br>';

$betweenMonth = function ($day) use ($dateTimeSection) {
    $betweenMonth = $dateTimeSection->betweenMonth($day);
    echo $betweenMonth->getBeginTimeFormat() . ' ~ ' . $betweenMonth->getEndTimeFormat();
};
echo '前一月：';
echo $betweenMonth(1);
echo '<br>';
echo '前两个月：';
echo $betweenMonth(2);
echo '<br>';
echo '前三个月：';
echo $betweenMonth(3);
echo '<br>';
echo '前八个月：';
echo $betweenMonth(8);

echo '<br>';
echo '<br>';

