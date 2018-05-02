<?php

namespace App\Console\Commands;

use App\Models\SsqFullModel;
use Illuminate\Console\Command;

class filterSSQ extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ssq:filter';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '过滤概率极低的双色球组合';

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
        $arr = [1,2,2,3,1,2];
        if($arr) {
//                dd($this->getTypeNum($arr));
        }
        //
        $id = 0;
        $row = 3;
        $deleteId = [];
        while (true) {
           $data =  SsqFullModel::select('id',"red1","red2","red3","red4","red5","red6")->where('id','>',$id)->take(300)->get();
           if(!$data) {break;}

           foreach ($data as $val) {
               $id = $val->id;
               $arr = [$val->red1,$val->red2,$val->red3,$val->red4,$val->red5,$val->red6];
               //过滤4位连号
               if($this->getContinueNum($arr)>3) {
                    $deleteId[] = $val->id;
               }
               //最大值必须是
               if($this->getMaxNum($arr)<10) {
                   $deleteId[] = $val->id;
               }
               //如果数字都在10位数段位那么过滤
               if($this->getTypeNum($arr)==1) {
                   $deleteId[] = $val->id;
               }
               if(count($deleteId)>1000) {
                   SsqFullModel::whereIn('id',$deleteId)->delete();
                   $deleteId = [];
               }
               //过滤全是10位数的

           }
           echo $id . "\r\n";
        }


    }

    /**
     * 获取一个数组的连续数字个数
     */
    public function getContinueNum($arr) {
        sort($arr);
        $continue = 0;
        foreach ($arr as $key=>$val)  {
            if(array_key_exists($key+1,$arr)) {
                $next = $arr[$key+1];
                if($next-$val==1) {
                    $continue ++;
                }

            }

        }
        return $continue;

    }

    /**
     * 获取双色球的最大值
     * @param $arr
     */
    public function getMaxNum($arr) {
        rsort($arr);
        return $arr[0];


    }

    /**
     * 获取双色球的种类
     * @param $arr
     */
    public function getTypeNum($arr) {
        $type1 = 0;
        $type2=0;
        $type3=0;
        foreach ($arr as $val) {
            if($val<=10) {
                $type1 =1;
            }
            if($val>10 and $val<=20) {
                $type2 = 1;
            }
            if($val>20) {
                $type3 = 1;
            }
        }
        return $type1 + $type2 + $type3;
    }
}
