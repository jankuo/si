<?php
/**
 * @description PHP SDK for 56 网  v2.0 (include using OAuth2),support by 56 open platform team
 * @
 * /

/**
 * @description 设定时区.
 */
define('API_TIMEZONE_OFFSET',8);
if(function_exists('date_default_timezone_set')) {
    @date_default_timezone_set('Etc/GMT'.(API_TIMEZONE_OFFSET > 0 ? '-' : '+').(abs(API_TIMEZONE_OFFSET)));
} else {
    putenv('Etc/GMT'.(API_TIMEZONE_OFFSET > 0 ? '-' : '+').(abs(API_TIMEZONE_OFFSET)));
}

/**
 * @description 常用配置.
 */	   	
error_reporting(E_ALL);
define('APPKEY','1000000010');
define('APPSECRET','0e4f13954bc537ec');
/**
 * @description 在oauth认证中请求的token
 */
define('ACCESS_TOKEN','');
define('CONNECT_TIMEOUT', 5);
define('READ_TIMEOUT', 5);

/**
 * @description 56网的接口类
 * 
 * @package open56Client
 */
class open56Client extends Exception{

    /**
    * 应用appkey
    */
    public $appkey; 
    /**
    * 应用secret  
    */
    public $secret;
    /**
    * 接口访问host
    */
    public $domain = "http://oapi.56.com:81";
    /**
    * 用户授权access_token
    */
    public $access_token;
    /**
    * 是否调试HTTP
    */
    public $isDebugHttp = false;


    public function __construct($appkey,$secret){
        if(empty($appkey) || empty($secret)){
            try {
                throw new Exception("appkey or secret cannot be empty!");
            } catch(Exception $e) {
                echo $e->getMessage();
            }
        }
        $this->appkey = $appkey;
        $this->secret = $secret;
    }

    /**
    * @description 设置access_token,提供需要oauth授权才能访问的接口设置用户access_token，该值参与客户端签名。
    * 
    * @access public
    * @param mixed $token
    * @return void
    */
    public function _setToken($token){
        if(!empty($token)){
            $this->access_token = $token;
        }	
        return $this;
    }

    /**
    * @description 简易上传组件地址
    * 
    * return void
    */
    public function uploadUrl(){
        $url    = $this->domain."/video/upload.plugin";
        $params = array();
        return $url.'?'.self::signRequest($params);
    }

    /**
    * 复杂上传组件地址
    * 
    * @param $sid 第三方的应用的用户名
    * @param $css 获取的样式加密码
    * @param $rurl 失败时跳转的页面，获取返回信息
    * @param $ourl 成功时跳转的页面，获取返回信息
    */
    public function customUrl($sid, $css, $rurl, $ourl){
        $url    = $this->domain."/video/custom.plugin";
        $params = array('sid'=> $sid,'css'=> $css ,'rurl'=> $rurl,'ourl'=> $ourl);
        return $url.'?'.self::signRequest($params);
    }

    /**
    * @description 获取视频信息
    * 
    * @param $flvid 56视频的flvid
    * @link /video/getVideoInfo.json
    * @return json
    */
    public function  getVideoInfoApp($flvid){
        $url    = $this->domain.'/video/getVideoInfo.json';
        $params = array('vid'=>$flvid);
        return self::getHttp($url,$params);
    }

    /**
    * @description 获取更新视频信息的接口
    * 
    * @param $flvid 56视频的flvid
    * @param $title 56视频的名称
    * @param $desc  56视频的名称的描述
    * @param $tag   56视频的标签
    * @link  /video/update.json
    * @return json
    */
    public function  updateApp($flvid,$title,$desc,$tag){
        $url    = $this->domain.'/video/update.json';
        $params = array('vid'=>$flvid,'title'=>$title,'desc'=>$desc,'tag'=>$tag);
        return self::getHttp($url,$params);
    }

    /*
    * @description 根据关键字获取搜索结果
    *   $data = array(
    *       'keyword'=> $keyword,  //要查找的关键字
    *       'c'=>1,
    *       't'=>'month', 时间，默认为month
    *       's'=>1,
    *       'page'=>1,     当前页数
    *       'rows'=>$rows, 10 每页显示多少个
    *    );  
    * @param $keyword 主要的字段，关键字搜索，其他的默认即可
    * @link  /video/search.json
    * @return json
    */
    public function  searchVideo($data){
        $url    = $this->domain.'/video/search.json';
        $params = array();
        $params = array_merge($params,$data);
        return self::getHttp($url,$params);
    }

    /**
    * @description 获取用户的个人信息
    * 
    * @param $userid 用户在56网站的user_id或视频的flvid
    * @param $token oauth2认证后的令牌
    * @link  /user/userProfile.json
    * @return json
    */
    public function userInfo($userid){
        $url	= $this->domain.'/user/userProfile.json';
        $params	= array('userid'=>$userid,'access_token'=>$token);
        return self::getHttp($url,$params);
    }

    /**
    * @description 获取用户的上传的视频
    * 
    * @param $userid 用户在56网站的user_id或视频的flvid
    * @param $token oauth2认证后的令牌
    * @link  /user/userVideos.json 
    * @return json
    */
    public function userVideos($userid){
        $url    = $this->domain.'/user/userVideos.json';
        $params = array('userid'=>$userid,'access_token'=>$token,'s'=>'time','page'=>1,'rows'=>10);
        return self::getHttp($url,$params);
    }

    /**
    * @description 获得用户的评论或视频的评论
    * 
    * @param $tid 用户在56网站的user_id或视频的flvid
    * @param $type user/flv
    * @param $token oauth2认证后的令牌
    * @param $pct  1为普通视频 3是相册视频
    * @return json
    */
    public function userComments($tid = 'onesec', $type = 'user', $pct = 1){
        $url    = $this->domain.'/user/userComments.json';
        $params = array('tid'=>$tid,'access_token'=>$token,'type'=> $type,'page'=>1,'rows'=>10, 'pct'=> $pct);
        return self::getHttp($url,$params);
    }

    /**
    * @description 获得频道的视频
    * 
    * @access public
    * @param string $cid
    * @param string $page
    * @param string $num
    * @return json
    */
    public function channelVideo($cid = '68', $page = '1', $num = '20'){
        $url    = $this->domain.'/video/channel.json';
        $params = array('cid'=>$cid, 'page'=>$page, 'num'=>$num);
        return self::getHttp($url,$params);
    }

    /**
    * @description 获得推荐频道的视频
    * 
    * @access public
    * @param string $mid
    * @param string $page
    * @param string $num
    * @return json
    */
    public function recommendVideo($mid = '16', $page = '1', $num = '10'){
        $url    = $this->domain.'/video/recommend.json';
        $params = array('mid'=>$mid, 'page'=>$page, 'num'=>$num);
        return self::getHttp($url,$params);
    }

    /**
    * @description 获得56网首页热门的视频
    * 
    * @access public
    * @param string $cid
    * @param string $page
    * @param string $num
    * @return json
    */
    public function hotVideo($cid = '2', $page = '1', $num = '10'){
        $url    = $this->domain.'/video/hot.json';
        $params = array('cid'=>$cid, 'page'=>$page, 'num'=>$num);
        return self::getHttp($url,$params);
    }

    /**
    * @description 获得56网昨天或某天的推荐的相册视频
    * 
    * @access public
    * @param mixed $day
    * @return json|void
    */
    public function albumVideo($day){
        $url    = $this->domain.'/video/recAlbum.json';
        $params = array('day'=>$day);
        return self::getHttp($url,$params);
    }

    /**
    * @description GET 方法
    * 
    * @access private
    * @param mixed $url
    * @param array $params
    * @return json
    */
    public  function getHttp($url,$params=array()){
        $url = $url.'?'.self::signRequest($params);
      ///  echo $url."<br>"; 
        return self::httpCall($url);
    }

    /**
    * @description  POST 方法
    * 
    * @access private
    * @param mixed $url
    * @param mixed $params
    * @return json
    */
    public  function postHttp($url,$params){
        return self::httpCall($url,self::signRequest($params),'post');
    }

    /**
    * @description  curl method,post方法params字符串的位置不同于get
    * 
    * @access public
    * @param mixed $url
    * @param string $params
    * @param string $method
    * @param mixed $connectTimeout
    * @param mixed $readTimeout
    * @return json
    */
    public function httpCall($url ,$params = '',$method = 'get', $connectTimeout = CONNECT_TIMEOUT, $readTimeout = READ_TIMEOUT) {

        $result = "";
        if (function_exists('curl_init')) {
            $timeout = $connectTimeout + $readTimeout;
            /** Use CURL if installed...  **/
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            if (strtolower($method)==='post'){ 
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
            }
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $connectTimeout);
            curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_USERAGENT, '56.com API PHP5 Client 1.1 (curl) ' . phpversion());
            $result = curl_exec($ch);
        } else{
            if (isset($params) and $params){
                $url = $url."?".http_build_query($params);
            }
            /** Non-CURL based version... */
            $ctx = stream_context_create(
                array(  
                    'http' => array(  
                        'timeout' => 5 //设置一个超时时间，单位为秒  
                    )  
                )  
            );  
            $result = file_get_contents($url, 0, $ctx);
        }
        return $result;
    }

    /**
    * @description 签名方法实现，并构造一个参数串
    * 
    * @access private
    * @param mixed $params
    * @return void
    */
    public  function signRequest($params){
        if ($this->access_token){
            $params['access_token'] = $this->access_token;
        }
        $keys   = self::urlencodeRfc3986(array_keys($params));
        $values = self::urlencodeRfc3986(array_values($params));
        if($keys and $values){
            $params = array_combine($keys,$values);
        }else{
            throw new Exception("signRequest need params exits!");
        }
        /**
        * 先去除系统级参数
        */
        unset($params['appkey']);
        unset($params['ts']); 
        ksort($params);
        /**
        * 第一轮md5字符串
        * */	
        $req   =  md5(http_build_query($params));
        $ts    =  time();/**当次请求的时间戳**/
        /**第二轮md5字符串,得到最后的签名变量,注意里面的顺序不可以改变否则结果错误!**/
        $params['sign']   = md5($req.'#'.$this->appkey.'#'.$this->secret.'#'.$ts);
        $params['appkey'] = $this->appkey;
        $params['ts']=$ts;

        return http_build_query($params);
    }

    /**
    * @description 转码异常字符
    * 
    * @access public
    * @param mixed $input
    * @return void
    */
    public static function urlencodeRfc3986($input){ 
        if (is_array($input)){
            return array_map( array('open56Client', 'urlencodeRfc3986') , $input );
        }else if( is_scalar($input)){
            return str_replace( '+' , ' ' , str_replace( '%7E' , '~' , rawurlencode($input)));
        }else{
            return '';
        }
    }
}