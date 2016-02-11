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

    public function actionGolable()
    {
        $str = "中文a字8数";
        // $str = "a";
        echo strlen($str)."<br>";//1个中文字符占位3字节，英文和数字占位1个字节，4*3+1+1=14 输出结果是14
        echo mb_strlen($str,'utf8')."<br>";//1个中文字节，字母，数字都占位1个字节 输出结果6
        echo mb_strlen($str,'gbk')."<br>";//1个中文字符占位2个字节，字母、数字占位1字节 4
        echo mb_strlen($str,'gb2312')."<br>";//1个中文字符占位2个字节，字母、数字占位1个字节 4*2+2*1=10  结果是10
    }

    //产生随机密码的函数
    public function actionMakepass()
    {
        $length = 4;
        $possible = "0123456789!@#$%^&*()_+".
        "abcdefghijklmnopqrstuvwxyz".
        "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $str = "";
        while(strlen($str)<$length)
        {
            $str.=substr($possible,(rand()%strlen($possible)),1);//%是对‘%’右边的数求余；例子：substr("abcdef", 1, 3);  // 返回 "bcd"
        }
        echo $str;
    }

    public function actionChangeformat()
    {
        echo substr("abcdef",1,-1)."<br>";//结果bcde
        echo substr("abcdef",-3,1)."<br>";//结果d
    }

    //根据日期获取是星期几
    public function actionGetDay()
    {
        $y = date("Y",time());
        $m = date("m",time());
        // $m = 2;
        $d = date("d",time());
        // $d = 1;
        if ($m==1||$m==2) {
            $m+=12;
            // var_dump($m+=12);
            // echo $m."<br>";
            $y--;
        }
        $t = $d+2*$m+bcdiv(3*($m+1), 5, 0)+$y+bcdiv($y, 4, 0)-bcdiv($y, 100, 0)+bcdiv($y, 400, 0);
        $result = ($t+1)%7;
        echo $result;
    }


}
?>