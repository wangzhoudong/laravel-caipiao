<?php
/**
 *------------------------------------------------------
 * dealOrderData.php
 *------------------------------------------------------
 *
 * @author    wangzhoudong@foxmail.com
 * @version   V1.0
 *
 */

namespace App\Console;

use App\Models\SsqModel;

class dealSsqData
{

    public static function update() {
        $crawler = \Goutte::request('GET', 'http://kaijiang.zhcw.com/zhcw/html/ssq/list.html');
        $crawler->filter('.wqhgt tr')->each(function ($node,$i) {
            //只检查前两条是否有更新
            if($i>1 && $i<4) {
                $data['issue'] = $node->filter('td')->eq(1)->text();
                $data['issue_date'] = $node->filter('td ')->eq(0)->text();
                $data['red1'] = $node->filter('td ')->eq(2)->filter('em')->eq(0)->text();
                $data['red2'] = $node->filter('td ')->eq(2)->filter('em')->eq(1)->text();
                $data['red3'] = $node->filter('td ')->eq(2)->filter('em')->eq(2)->text();
                $data['red4'] = $node->filter('td ')->eq(2)->filter('em')->eq(3)->text();
                $data['red5'] = $node->filter('td ')->eq(2)->filter('em')->eq(4)->text();
                $data['red6'] = $node->filter('td ')->eq(2)->filter('em')->eq(5)->text();
                $data['blue'] = $node->filter('td ')->eq(2)->filter('em')->eq(6)->text();
                $data['desc'] = getSSQDesc($data['red1'],$data['red2'],$data['red3'],$data['red4'],$data['red5'],$data['red6'],$data['blue']);
                $data['md5'] = getSSQDescMd5($data['desc']);
                $data['sales_amount'] = (int)trim(str_replace(',','',$node->filter('td')->eq(3)->filter('strong')->text()));
                $data['first_prize'] = (int)$node->filter('td ')->eq(4)->filter('strong')->text();
                $data['second_prize'] = (int)$node->filter('td ')->eq(5)->filter('strong')->text();
                $ok = SsqModel::updateOrCreate(['issue'=>$data['issue']],$data);
                if(!$ok) {
                    echo "创建失败" . $data['issue'] . "\r\n";
                    \Mail::raw('采集双色球失败了！！！', function ($message) {
                        $message->to('563808802@qq.com','管理员')->subject('意境吧-彩票-采集');
                    });
                }else{
                    echo $data['issue'] . "\r\n";
                }
            }
        });
    }




}