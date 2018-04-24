<?php

namespace App\Console\Commands;

use App\Models\SsqFullModel;
use Illuminate\Console\Command;

class sendFullSSQ extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ssq:sendFull';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '生成全量双色球数据';

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
        echo "ddd\r\n";
        $startRow = 0;
        for ($red1=1;$red1<=28;$red1++) {
            for ($red2=$red1+1;$red2<=29;$red2++) {
                for ($red3=$red2+1;$red3<=30;$red3++) {
                    for ($red4=$red3+1;$red4<=31;$red4++) {
                        for ($red5=$red4+1;$red5<=32;$red5++) {
                            for ($red6=$red5+1;$red6<=33;$red6++) {
                                for ($blue=1;$blue<=16;$blue++) {
                                    $startRow = $startRow + 1;
                                    echo $startRow . "\r\n";


                                    $desc =  getSSQDesc($red1,$red2,$red3,$red4,$red5,$red6,$blue) . "\r\n";
                                    SsqFullModel::create([
                                            'red1'=>$red1,
                                            'red2'=>$red2,
                                            'red3'=>$red3,
                                            'red4'=>$red4,
                                            'red5'=>$red5,
                                            'red6'=>$red6,
                                            'blue'=>$blue,
                                            'desc'=> $desc,
                                            'md5'=> getSSQDescMd5($desc)
                                        ]);
                                }

                            }
                        }
                    }
                }
            }
        }
//        SsqFullModel::create([]);
    }
}
