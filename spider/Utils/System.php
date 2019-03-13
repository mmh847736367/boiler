<?php


namespace Spider\Utils;


class System
{

    public static function get_used_status(){

        $fp = popen('top -b -n 1 | grep -E "^(Cpu|Mem|Tasks)"',"r");//获取某一时刻系统cpu和内存使用情况
        $rs = "";

        while(!feof($fp)){
            $rs .= fread($fp,1024);
        }

        pclose($fp);
        $sys_info = explode("\n",$rs);
        $tast_info = explode(",",$sys_info[0]);//进程 数组
        $cpu_info = explode(",",$sys_info[1]);  //CPU占有量  数组
        $mem_info = explode(",",$sys_info[2]); //内存占有量 数组
        //正在运行的进程数
        $tast_running = trim(trim($tast_info[1],'running'));


        //CPU占有量
        $cpu_usage = trim(trim($cpu_info[0],'Cpu(s): '),'%us');  //百分比

        //内存占有量
        $mem_total = trim(trim($mem_info[0],'Mem: '),'k total');
        $mem_used = trim($mem_info[1],'k used');
        $mem_usage = round(100*intval($mem_used)/intval($mem_total),2);  //百分比


        $fp = popen('df -lh | grep -E "^(/dev/sdb1)"',"r");
        $rs = fread($fp,1024);
        pclose($fp);
        $rs = preg_replace("/\s{2,}/",' ',$rs);  //把多个空格换成 “_”
        $hd = explode(" ",$rs);
        $hd_avail = trim($hd[3],'G'); //磁盘可用空间大小 单位G
        $hd_usage = trim($hd[4],'%'); //挂载点 百分比
        //print_r($hd);

        $fp = popen('du -sh /data/mysql', "r");
        $fs = fread($fp, 1024);
        pclose($fp);
        $hd = explode(" ",$fs);
        dd($hd);
        $mysql_hd_usage = trim($hd[0], 'G');

        return [
            'cpu_usage'=>$cpu_usage,
            'mem_usage'=>$mem_usage,
            'hd_avail'=>$hd_avail,
            'hd_usage'=>$hd_usage,
            'tast_running'=>$tast_running,
            'mysql_hd_useage' => $mysql_hd_usage
        ];
    }
}