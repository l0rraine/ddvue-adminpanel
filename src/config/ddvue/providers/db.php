<?php
/**
 * Created by PhpStorm.
 * User: idn-lee
 * Date: 18-2-22
 * Time: 上午10:29
 */
return [
    'driver' => 'eloquent',
    'model'  => app('config')['ddvue.adminpanel.auth.user_model'],
];