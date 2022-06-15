<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

Route::group('admin',function (){
    Route::rule('login','admin/user/login','get|post');
    Route::rule('register','admin/user/register','get|post');
    Route::rule('main','admin/flight/main','get|post');
    Route::rule('logout','admin/user/logout','get|post');
    Route::rule('passengerlist','admin/passenger/passengerlist','get|post');
    Route::rule('passengeradd','admin/passenger/passengeradd','get|post');
    Route::rule('passengerdelete/[:idNumber]','admin/passenger/passengerdelete','get|post');
    Route::rule('linkadd','admin/link/linkadd','get|post');
    Route::rule('linkdelete','admin/link/linkdelete','get|post');
    Route::rule('executive','admin/executiveflight/executive','get|post');
    Route::rule('infosave','admin/executiveflight/infosave','get|post');
    Route::rule('execsearch','admin/executiveflight/execsearch','get|post');
    Route::rule('orderlist','admin/order/orderlist','get|post');
    Route::rule('orderadd','admin/order/orderadd','get|post');
    Route::rule('orderone','admin/order/orderone','get|post');
    Route::rule('orderdelete/[:orderId]','admin/order/orderdelete','get|post');
    Route::rule('ticketadd','admin/ticket/ticketadd','get|post');
    Route::rule('ticketlist','admin/ticket/ticketlist','get|post');
    Route::rule('ticketedit','admin/ticket/ticketedit','get|post');
    Route::rule('ticketdelete','admin/ticket/ticketdelete','get|post');
    Route::rule('finish','admin/ticket/finish','get|post');
    Route::rule('seatlist/[:shippingId]','admin/seat/seatlist','get|post');
    Route::rule('seatadd','admin/seatchosen/seatadd','get|post');
});
