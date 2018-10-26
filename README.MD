### 时间字符串处理
 >DateTimeAttr.php 把一个时间戳或者时间字符串处理成对象，可以获得字符串里面的信息
 
    $dateTime = '2017/5/26';
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
    
 > DateTimeSection.php 基于一个时间戳获取常用的时间段
 
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