<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\SsqModel;


class dealSSQ extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ssq:deal';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '一次性采集双色球开奖数据';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $page = $this->ask('请输入http://kaijiang.zhcw.com/zhcw/html/ssq/list.html地址的总页数');
        for($i=1;$i<=$page;$i++) {
            echo $i . "\r\n";
            $crawler = \Goutte::request('GET', 'http://kaijiang.zhcw.com/zhcw/html/ssq/list_' . $i . '.html');
            $crawler->filter('.wqhgt tr')->each(function ($node,$i){
                if($i>1 && $node->filter('td ')->eq(0)->attr('colspan')!=7) {
                    $data['issue_date'] = $node->filter('td ')->eq(0)->text();
                    $data['issue'] = $node->filter('td ')->eq(1)->text();
                    $data['red1'] = $node->filter('td ')->eq(2)->filter('em')->eq(0)->text();
                    $data['red2'] = $node->filter('td ')->eq(2)->filter('em')->eq(1)->text();
                    $data['red3'] = $node->filter('td ')->eq(2)->filter('em')->eq(2)->text();
                    $data['red4'] = $node->filter('td ')->eq(2)->filter('em')->eq(3)->text();
                    $data['red5'] = $node->filter('td ')->eq(2)->filter('em')->eq(4)->text();
                    $data['red6'] = $node->filter('td ')->eq(2)->filter('em')->eq(5)->text();
                    $data['blue'] = $node->filter('td ')->eq(2)->filter('em')->eq(6)->text();
                    $data['desc'] = getSSQDesc($data['red1'],$data['red2'],$data['red3'],$data['red4'],$data['red5'],$data['red6'],$data['blue']);
                    $data['md5'] = getSSQDescMd5($data['desc']);
                    $data['sales_amount'] = str_replace(',','',$node->filter('td ')->eq(3)->text());
                    $data['first_prize'] = $node->filter('td ')->eq(4)->filter('strong')->text();
                    $data['second_prize'] = $node->filter('td ')->eq(5)->filter('strong')->text();
                    $ok = SsqModel::create($data);
                    if(!$ok) {
                        echo "创建失败" . $data['issue'] . "\r\n";
                    }else{
                        echo $data['issue'] . "\r\n";
                    }
                }
            });
        }
    }
}
