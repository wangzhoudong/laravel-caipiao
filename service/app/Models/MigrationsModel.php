<?php
/**
 *------------------------------------------------------
 * MigrationsModel.php
 *------------------------------------------------------
 *
 * @author    wangzhoudong@foxmail.com
 * @date      2018/04/24 07:34
 * @version   V1.0
 *
 */

namespace App\Models;

class MigrationsModel extends BaseModel
{
    /**
     * 数据表名
     */
    protected $table = "migrations";

    /**
     * 主键
     */
    protected $primaryKey = "id";

    /**
     * 可以被集体附值的表的字段
     */
    protected $fillable = [
        'migration',
        'batch'
    ];

}