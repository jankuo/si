<?php
/**************************************************
*  Created:  2011-03-07
*
*  WAP账号控制器
*
*  @Xweibo (C)1996-2099 SINA Inc.
*  @Author guanghui <guanghui1@staff.sina.com.cn>
*
***************************************************/
include('action.basic.php');

class index_mod extends action
{

    function index_mod()
    {
        parent::action();
    }
    
    
    function default_action()
    {
       echo "House,Wife,Car,All i need!";
    }
    
    function think()
    {
       echo "111 Me of who!";
    }
    /**
    * 检查当前控制器是否WAP目录下的控制器
    * 如果不是，则自动跳转至WAP目录下的默认控制器
    * 
    */
    function checkCtrl()
    {
        return true;
    }
}
