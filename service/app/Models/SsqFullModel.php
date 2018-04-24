<?php
/**
 *------------------------------------------------------
 * SsqFullModel.php
 *------------------------------------------------------
 *
 * @author    wangzhoudong@foxmail.com
 * @date      2018/04/24 07:34
 * @version   V1.0
 *
 */

namespace App\Models;

class SsqFullModel extends BaseModel
{
    /**
     * 数据表名
     */
    protected $table = "ssq_full";

    /**
     * 主键
     */
    protected $primaryKey = "";

    /**
     * 可以被集体附值的表的字段
     */
    protected $fillable = [
        'id',
        'red1',
        'red2',
        'red3',
        'red4',
        'red5',
        'red6',
        'blue',
        'desc',
        'md5'
    ];

}