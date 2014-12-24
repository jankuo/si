<?php

class demo_mod
{

    function demo_mod()
    {
        
    }

    /**
     * 首页
     *
     *
     */
    function default_action()
    {

        $test_data = "11111";
        TPL::assign('test_data', $test_data);
        TPL::display('test');
    }
    
    function index()
    {
        print_r("dd");
        TPL::display('test');
    }

    /**
     * 我的微博列表
     *
     *
     */
    function profile()
    {
/*
        //过滤类型
        $filter_type = V('g:filter_type');

        /// 页码数
        $page = max(V('g:page'), 1);

        /// 设置每页显示微博数
        $limit = V('-:userConfig/user_page_wb');
        $count = $limit;

        /// 调用获取用户发布的微博信息列表api
        $list = DR('xweibo/xwb.getUserTimeline', '', USER::uid(), null, null, null, null, $count, $page, $filter_type);
        $list = $list['rst'];
*/
        /// 调用微博个人资料接口
        $userinfo = DR('xweibo/xwb.getUserShow', 'p', USER::uid());
        $userinfo = $userinfo['rst'];
        /// 过滤过敏用户
        $userinfo = F('user_filter', $userinfo, true);
        if (empty($userinfo)) {
            /// 提示不存在
            APP::tips(array('tpl' => 'e404', 'msg' => L('controller__common__userNotExist')));
        } 

        $modules = DS('PageModule.getPageModules', '', 2, 1);

//		TPL::assign('list', $list);
        TPL::assign('uid', USER::uid());
//		TPL::assign('limit', $limit);
//		TPL::assign('filter_type', $filter_type);
        TPL::assign('side_modules', isset($modules[2]) ? $modules[2]: array());
        TPL::assign('userinfo', $userinfo);
        TPL::display('profile');
    }
}
