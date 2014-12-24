<?php

class index_mod
{
    
    public $con;
    public $api;
    
    function index_mod()
    {
        $this->con = APP::O('open56Client',"1000000010","0e4f13954bc537ec");
    }

    /**
     * 首页define('APPKEY','1000000010');
        define('APPSECRET','0e4f13954bc537ec');
     *
     *
     */
    function default_action()
    {
       $mm = APP::ADP('cache');
       
       $key_hot   = md5("hot_video_cid_2_page_1_num_10"); 
       $key_ent   = md5("ent_video_cid_1_page_1_num_10"); 
       $key_ori   = md5("ori_video_cid_3_page_1_num_10"); 
       $key_mtv   = md5("mtv_video_cid_8_page_1_num_10"); 
       $key_sport = md5("sport_video_cid_14_page_1_num_10"); 
       $key_game  = md5("game_video_cid_26_page_1_num_10"); 
       $key_car   = md5("car_video_cid_28_page_1_num_10"); 
       $key_edu   = md5("edu_video_cid_10_page_1_num_10"); 
       $key_trip  = md5("trip_video_cid_27_page_1_num_10"); 
       $key_fun   = md5("fun_video_cid_4_page_1_num_10"); 

       /***/
       if( !$hot = $mm->get($key_hot)){
           
           $hot  = $this->con->hotVideo(2);
           if($hot){
               $mm->set($key_hot, $hot);
           }
       }
       $hot = json_decode($hot, true);
       
       
      if( !$ent = $mm->get($key_ent)){
           
            $ent = $this->con->hotVideo(1);
           if($ent){
               $mm->set($key_ent, $ent);
           }
       }
       $ent = json_decode($ent, true);
       
       
       if( !$ori = $mm->get($key_ori)){
           
           $ori = $this->con->hotVideo(3);
           if($ori){
               $mm->set($key_ori, $ori);
           }
       }
       $ori = json_decode($ori, true);
       
       
      if( !$mtv = $mm->get($key_mtv)){
           
           $mtv = $this->con->hotVideo(8);
           if($mtv){
               $mm->set($key_mtv, $mtv);
           }
       }
       $mtv = json_decode($mtv, true);
       
       
       if( !$sport = $mm->get($key_sport)){
           
            $sport = $this->con->hotVideo(14);
           if($hot){
               $mm->set($key_sport, $sport);
           }
       }
       $sport = json_decode($sport, true);
       
       
      if( !$game = $mm->get($key_game)){
           
           $game = $this->con->hotVideo(26);
           if($game){
               $mm->set($key_game, $game);
           }
       }
       $game = json_decode($game, true);
       
       
       if( !$car = $mm->get($key_car)){
           
           $car  = $this->con->hotVideo(28);
           if($car){
               $mm->set($key_car, $car);
           }
       }
       $car = json_decode($car, true);
       
      if( !$edu = $mm->get($key_edu)){
           
           $edu = $this->con->hotVideo(10);
           if($edu){
               $mm->set($key_edu, $edu);
           }
       }
       $edu = json_decode($edu, true);
       
       
       if( !$trip = $mm->get($key_trip)){
           
           $trip = $this->con->hotVideo(27);
           if($trip){
               $mm->set($key_trip, $trip);
           }
       }
       $trip = json_decode($trip, true);
       
       
      if( !$fun = $mm->get($key_fun)){
           
           $fun = $this->con->hotVideo(4);
           if($fun){
               $mm->set($key_fun, $fun);
           }
       }
       $fun = json_decode($fun, true);
       
       TPL::assign('hot', $hot);
       TPL::assign('ent', $ent);
       TPL::assign('ori', $ori);
       TPL::assign('mtv', $mtv);
       TPL::assign('sport', $trip);
       TPL::assign('game', $fun);
       TPL::display('index');
    }

    function index()
    {

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
