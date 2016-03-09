<?php
class TestController extends Controller
{
    public function actionNext()
    {
        $today = date("Y-m-d H:i:s",time());
        echo "现在时间：".$today."<br/>";
        $tomorrow = date("Y-m-d H:i:s",strtotime('+1 day'));
        echo "明天此时时间：".$tomorrow."<br>";
        $yesterday = date("Y-m-d H:i:s", strtotime('-1 day'));
        echo "昨天时间：".$yesterday."<br>";
        $next_week = date("Y-m-d H:i:s", strtotime('+1 week'));
        echo "下个星期同一时间".$next_week."<br>";
        $last_week = date("Y-m-d H:i:s", strtotime('-1 week'));
        echo "上个星期同一时间".$last_week."<br>";
        $next_weekday = date("Y-m-d H:i:s", strtotime('next Thursday'));
        echo "下星期四的时间".$next_weekday."<br>";
        $next_monday = date("Y-m-d H:i:s", strtotime('next Monday'));
        echo "下星期一：".$next_monday."<br>";
        $last_monday = date("Y-m-d H:i:s", strtotime('last Monday'));
        echo "上星期一：".$last_monday."<br>";
    }
}
?>