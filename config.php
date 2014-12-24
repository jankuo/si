<?php
/**
 * @file			config.php
 * @CopyRight		(C)1996-2099 SINA Inc.
 * @Project			Xweibo
 * @Author			xionghui <xionghui1@staff.sina.com.cn>
 * @Create Date:	2010-06-08
 * @Modified By:	xionghui/2010-11-15
 * @Brief			系统配置文件
 */
//----------------------------------------------------------------------
/// 产品名称
define('WB_SOFT_NAME', 'Xweibo');
/// 当前版本号
define('WB_VERSION', '2.2');
/// 项目号 用于统计
define('WB_PROJECT', 'xwb');
/// 系统默认的模块路由 当入口文件中未定义时使用如下值
if ( !defined('R_DEF_MOD') ){define('R_DEF_MOD', "index");}
//----------------------------------------------------------------------
// 本地安全 solt string
define('AUTH_KEY',			'XMBLOG654321');
/// 站点语言名称（目录）
define('SITE_LANG',			'zh_cn');
/// 站点皮肤  CSS 文件目录名称的 前缀
define('SITE_SKIN_CSS_PRE',	'skin_');
/// 站点皮肤 CSS 自定义皮肤目录
define('SITE_SKIN_CSS_CUSTOM',	'skin_define');
/// 站点皮肤  CSS 文件目录名称的 后缀
/// 当用户和系统都没有设置,且不能从预览变量路由中取得CSS皮肤值的时候即为当前值
define('SITE_SKIN_TYPE',	'default');
/// 站点皮肤  模板目录名称（目录）
define('SITE_SKIN_TPL_DIR',	'default');
/// 预览皮肤时的 变量路由
define('SITE_SKIN_PREV_V',	'R:prev_skin');
/// 皮肤配置文件名称
define('SKIN_CONFIG',		'skinconfig.ini');
/// 皮肤预览图片名称
define('SKIN_PRE_PIC',		'thumbpic.png');

/// 字体目录
define('WB_FONT_PATH',			P_VAR_DATA . '/fonts');
/// 微博列表默认显示条数
define('WB_API_LIMIT',			20);
/// 默认时区
define('APP_TIMEZONE_OFFSET',	8);
/// 本地时间，与标准时间的差，单位为秒，当本地时钟较快时为　负数　，较慢时为　正数　, 默认为　０　即本地时间是准确的
define('LOCAL_TIME_OFFSET',		0);
/// 经过较准的，本地时间戳　所有使用APP_LOCAL_TIMESTAMP　的地方用这个常替代，防止，无法更改服务器时间导致的问题
define('APP_LOCAL_TIMESTAMP',	time() + LOCAL_TIME_OFFSET);

/// 定时程序锁文件前缀
define('CRON_LOCK_FILE_PREFIX', 'cron_lock_');
//----------------------------------------------------------------------
/// 站点LOGO文件名

define('WB_LOGO_PREVIEW_FILE_NAME',	'/data/logo/logo_previews.png');
/// 站点地址栏文件名
//----------------------------------------------------------------------
/// API 相关
/// 微博 api url
define('WEIBO_API_URL', 	'');
/// sinaurl.cn 地址信息查询API地址

//----------------------------------------------------------------------
/// 数据库名表名 content_unit
define('T_CONTENT_UNIT',	'content_unit');
/// 聚焦位
define('T_FOCUS_AD',		'focus_ad');

//---------------------------------------------------------------------
/// cache下标定义 屏蔽回复
define('CACHE_DISABLED_COMMENT',			'disabled_comment');
/// cache下标定义  屏蔽微博

//----------------------------------------------------------------------
/// 全局配置变量
$cfg = array();
//----------------------------------------------------------------------
/// 适配器选择器
$cfg['adapter'] = array(
    'io'		=> FILE_ADAPTER,
    'db'		=> DB_ADAPTER,
    'http'		=> HTTP_ADAPTER,
    'cache'		=> CACHE_ADAPTER,
    'mailer'	=> SMTP_ADAPTER,
    'account'	=> ACCOUNT_ADAPTER,
    'upload'	=> UPLOAD_ADAPTER,
    'auth'		=> AUTH_ADAPTER,
    'image' 	=> IMAGE_ADAPTER,
    'mail'		=> MAIL_ADAPTER,
    'log'		=> LOG_ADAPTER
);
//----------------------------------------------------------------------
/// 适配器初始化数据配置变量
$cfg['adapter_cfg'] = array();
$_adapter = &$cfg['adapter_cfg'];
//----------------------------------------------------------------------
$_adapter['db'] = array();
$_adapter['account']['dzUcenter'] = array(
    'homeUrl'		=>'',
    'home2'			=>''
);

//----------------------------------------------------------------------
$_adapter['db'] = array();
$_adapter['db']['mysql'] = array(
    'host'	 => DB_HOST,
    'port'	 => DB_PORT,
    'user'	 => DB_USER,
    'pwd'	 => DB_PASSWD,
    'charset'=> DB_CHARSET,
    'tbpre'	 => DB_PREFIX,
    'db'	 => DB_NAME,
    'slaves' => array(
            array(
                'host'	 => DB_HOST_2,
                'port'	 => DB_PORT,
                'user'	 => DB_USER,
                'pwd'	 => DB_PASSWD,
                )
        )
);
//---------------------------------------------图片处理---------------------
$_adapter['image'] = array();
$_adapter['image']['sae'] = array();
//---------------------------------------------验证码---------------------
$_adapter['auth'] = array();
$_adapter['auth']['sae'] = array();
//----------------------------------------------------------------------
$_adapter['upload'] = array();
$_adapter['upload']['upload'] = array();
//----------------------------------------------------------------------
$_adapter['io'] = array();
$_adapter['io']['file'] = array();
$_adapter['io']['ftp']	= array();
//----------------------------------------------------------------------
$_adapter['http'] = array();
$_adapter['http']['curl'] 		= array();
$_adapter['http']['fsockopen'] 	= array();
$_adapter['http']['snoopy'] 	= array();
//----------------------------------------------------------------------
$_adapter['mail'] = array();
$_adapter['mail']['sae']		= array();
//----------------------------------------------------------------------
$_adapter['cache'] = array();
$_adapter['cache']['file'] 				= array(
    'baseDir'=>		P_VAR_CACHE,
    'pathLevel'=>	3,
    'nameLen'=>		2,
    'varName'=>		'__cache_data'
);
$_adapter['cache']['serialize'] 		= array(
    'baseDir'=>		P_VAR_CACHE,
    'pathLevel'=>	3,
    'nameLen'=>		2
);

$_adapter['cache']['xcache'] 			= array();
$_adapter['cache']['memcache'] 			= array(
    'pconnect'=>false,
    'servers'=>	MC_HOST,
    'keyPre'=>	MC_PREFIX
);
$_adapter['cache']['eaccelerator'] 		= array();
//----------------------------------------------------------------------
$_adapter['mail'] = array();
$_adapter['mail']['mail'] 	= array();
$_adapter['mail']['smtp']	= array();
//----------------------------------------------------------------------
/// WB api接口错误状态吗
$cfg['apierrno'] = array('400', '403', '404', '500');
//----------------------------------------------------------------------
/// 访问控制列表
$aclTable = &$cfg['aclTable'];
/// TODO入口控制配置 : 入口名 路由匹配正则 控制选项 （选项为 true 时 表示匹配的路由被允许访问 ）
$aclTable['E']		= array();
$aclTable['E'][]	= array('admin',	"#^admin/.*#sim",true);
$aclTable['E'][]	= array('index',	"#^admin/.*#sim",false);

/// IP控制配置 ： 入口名称 IP匹配正则 控制选项
$aclTable['IP']		= array();
//$aclTable['IP'][]	= array('index',"",true);

//----------------------------------------------------------------------
// 模板使用的配置变量，使用方法：  V('-:tpl/title');
$tpl = &$cfg['tpl'];
$tpl['title'] = array(
            //标题前缀
            '_pre' => '',
            //标题后缀
            '_suf' => ' - Powered By Xweibo',

            //根据页面路由配置页面标题，可使用格式 如下
            'comDemo.tit'=> 'pageTitle__comDemo__title',
            );


//----------------------------------------------------------------------
/// 缓存时间设置, route+desc=time, time 以秒为单位
$tpl['cache_time'] = array(
    'output_nologin' 				=> 300,
    'output_type1_login' 			=> 300,			// 微博秀
    'output_type2_login' 			=> 300,			// 推荐guanz
    'output_type3_login' 			=> 30,			// 互动话题
    'pagelet_component1'			=> 300,			// 热门转发与评论
    'pagelet_component2'			=> 300,			// 用户组
    'pagelet_component3'			=> 300,			// 推荐用户
    'pagelet_component4'			=> 300,			// 人气关注榜模块
    'pagelet_component5'			=> 30,			// 群组微博
    'pagelet_component6'			=> 300,			// 话题推荐列表
    'pagelet_component7'			=> 300,			// 可能感兴趣的人(未登录，不显示)
    'pagelet_component8'			=> 300,			// 同城微博(未登录缓存, 登录不缓存)
    'pagelet_component9'			=> 30,			// 随便看看
    'pagelet_component10'			=> 30,			// 今日话题(未登录缓存, 登录不缓存)
    'pagelet_component11'			=> 300,			// 用户组
    'pagelet_component12'			=> 30,			// 话题微博
    'pagelet_component14'			=> 300,			// 最新微博
    'pagelet_component15'			=> 300,			// 最新用户
    'pagelet_component18'			=> 300,			// 活动列表
    'pagelet_component19'			=> 300			// 本地关注榜
);
                                     
/// xweibo模板配置
define('PAGE_TYPE_SYSCONFIG', 	'wb_page_type');
define('PAGE_TYPE_DEFAULT', 	'2');
/// 两栏不显示的后台
$cfg['adminNotShowNav'][1] = array(
        'mgr/setting.header' => 1
    );
/// 三栏不显示的后台
$cfg['adminNotShowNav'][2] = array(
        'mgr/skin' 						=> 1,
        'mgr/setting.getlink.header'	=> 1,
        'mgr/ad' 						=> 1
    );

/// weibo页头设置
define('HEADER_MODEL_SYSCONFIG', 	'wb_header_model');
define('HEADER_HTMLCODE_SYSCONFIG', 'wb_header_htmlcode');
//----------------------------------------------------------------------
/// 是否启用私信功能，FALSE：不启用；TRUE：启用
define('HAS_DIRECT_MESSAGES', FALSE);
/// 是否启用个人资料功能，FALSE：不启用；TRUE：启用
define('HAS_DIRECT_UPDATE_PROFILE', FALSE);
/// 是否启用修改头像功能，FALSE：不启用；TRUE：启用
define('HAS_DIRECT_UPDATE_PROFILE_IMAGE', FALSE);
