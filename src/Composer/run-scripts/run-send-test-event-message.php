<?php
include_once dirname(dirname(dirname(__DIR__))).'/autoload.php';

use \Zwei\RabbitMqEvent\Base\EventMessage;

date_default_timezone_set('PRC');


$eventKey       = !isset($argv[1]) ? 10 : $argv[1];// 默认运行5次
$runCount       = !isset($argv[2]) ? 10 : $argv[2];// 默认运行5次
$intervalTime   = !isset($argv[3]) ? 1 : $argv[3];// 间隔时间
$nowRunCount    = 0;

$startTime      = microtime();
$startTimeArr   = explode(' ', $startTime);
$startTime      = $startTimeArr[1] + $startTimeArr[0];
$startDate      = date('Y-m-d H:i:s', $startTime);
echo <<<str

start event message
    event-key: $eventKey
    run-count: $runCount # runs(-1:unlimited rum times, run-count > 0 limit run times)[defailt: 10 times]
interval-time: $intervalTime # interval time in seconds[default: 1 seconds]
   start-time: {$startDate}


str;

while ($runCount == -1 || $runCount > 0) {
    if ($runCount > 0) {
        $runCount --;
    }
    $nowRunCount ++;
    $data = [
        'date' => date('Y-m-d H:i:s'),
        "runId" => $nowRunCount,
    ];
    EventMessage::send($eventKey, $data);
    echo sprintf("[%d][event-key: %s] send event message\n", $nowRunCount, $eventKey);
    $intervalTime > 0 ? sleep($intervalTime) : null;
}

$endTime      = microtime();
$endTimeArr   = explode(' ', $endTime);
$endTime = $endTimeArr[1] + $endTimeArr[0];
$endDate      = date('Y-m-d H:i:s', $endTime);

$runTime = $endTime - $startTime;
echo <<<str

   start-time: {$startDate}
     end-time: {$endDate}
    run-times: {$nowRunCount} times
     run-time: {$runTime} seconds
end event message


str;
