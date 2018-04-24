<?php
/**
 *------------------------------------------------------
 * UsersModel.php
 *------------------------------------------------------
 *
 * @author    wangzhoudong@foxmail.com
 * @date      2018/04/24 07:34
 * @version   V1.0
 *
 */

namespace App\Models;

class UsersModel extends BaseModel
{
    /**
     * 数据表名
     */
    protected $table = "users";

    /**
     * 主键
     */
    protected $primaryKey = "id";

    /**
     * 可以被集体附值的表的字段
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'remember_token'
    ];

}