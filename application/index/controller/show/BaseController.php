<?php
/**
 * Created by 信磊.
 * Date: 2017/8/6
 * Time: 14:47
 */

namespace app\index\controller\show;


use think\Controller;
use think\Db;
use think\Exception;
use think\Loader;
use think\View;

//引入新浪微博SDK
Loader::import('Weibo.saetv2', EXTEND_PATH, '.ex.class.php');
//引入QQ互联SDK
loader::import('QQApi.qqConnectAPI',EXTEND_PATH,'.class.php');

class BaseController extends Controller
{
    public function __construct()
    {
        if (session('token')) {
            if(session('login_type') == 'sina'){
                #Sina OAuth2.0 code
                $this->isSinaLogin();
            }else if(session('login_type') == 'qq'){
                #QQ OAuth2.0 code
                $this->isQQLogin();
            }
        }

        //首页个人信息
        $myData = Db::table('blog_author_about')
            ->field('top_img,name,introduce,address,qq_link,email_link,sina_link,git_link')
            ->find();

        $title = '文海阁';
        View::share([
            'title'     => $title,
            'myData'    => $myData]);

    }

    public function isQQLogin(){
        if (!session('nickname')) {
            $qc         = new \QC(session('token'), session('openid'));
            $user_info  = $qc->get_user_info();
            //检测此qq是否授权过此网站
            $where['openid'] = session('openid');
            $isqq = Db::table('blog_qq')->where($where)->find();
            if($isqq){
                #已注册过 code......
                session('nickname',$user_info['nickname']);
                session('figureurl',$user_info['figureurl_qq_2']);
                session('login_type','qq');

            }else{
                #未注册过 code......
                $qq_data = [
                    'openid'    =>  session('openid'),
                    'nickname'  =>  $user_info['nickname'],
                    'gender'    =>  $user_info['gender'],
                    'province'  =>  $user_info['province'],
                    'city'      =>  $user_info['city'],
                    'year'      =>  $user_info['year'],
                    'figureurl_qq_40'   =>  $user_info['figureurl_qq_1'],
                    'figureurl_qq_100'  =>  $user_info['figureurl_qq_2'],
                    'ip'  =>  request()->ip()
                ];
                $res = Db::table('blog_qq')->insert($qq_data);
                if ($res) {
                    session('nickname',$user_info['nickname']);
                    session('figureurl',$user_info['figureurl_qq_2']);
                    session('login_type','qq');
                }
            }
            //查询登陆的是否是管理员
            $admin = Db::table('blog_qq')
                ->where('isadmin', '=', 'admin')
                ->where('openid', '=', session('openid'))
                ->value('isadmin');
            if ($admin) {
                View::share('admin', $admin);
            }
            //分发qq数据模板变量
            View::share([
                'name' => session('nickname'),               //QQ昵称
                'top'  => session('figureurl')               //QQ头像
            ]);
        } else {
            //查询登陆的是否是管理员
            $admin = Db::table('blog_qq')
                ->where('isadmin', '=', 'admin')
                ->where('openid', '=', session('openid'))
                ->value('isadmin');
            if ($admin) {
                View::share('admin', $admin);
            }
            //分发qq数据模板变量
            View::share([
                'name' => session('nickname'),               //QQ昵称
                'top'  => session('figureurl')               //QQ头像
            ]);
        }
    }

    public function isSinaLogin(){
        if (!isset(session('weibo')['id'])) {
            //实例化新浪SDK，传入app_key和app_secret
            $o = new \SaeTClientV2(config('ConnectSDK.app_key'), config('ConnectSDK.app_secret'), session('token')['access_token']);
            //获取uid
            $uid = $o->get_uid();
            //根据uid获取用户基本资料和最新的微博
            $weiboData = $o->show_user_by_id($uid['uid']);
            session('weibo', $weiboData);
            //session存入登陆类型
//            session('login_type', 'sina');
            if (isset($weiboData['id'])) {
                //存入数据库
                $data = [
                    'uid'                    => $weiboData['id'],
                    'name'                   => $weiboData['name'],
                    'city'                   => $weiboData['city'],
                    'profile_image_url_50'   => $weiboData['profile_image_url'],
                    'profile_image_url_180'  => $weiboData['avatar_large'],
                    'profile_image_url_1024' => $weiboData['avatar_hd'],
                    'ip'                     => request()->ip()
                ];
                try {
                    Db::table('blog_weibo')->insert($data);
                } catch (Exception $e) {}
                //查询登陆的是否是管理员
                $admin = Db::table('blog_weibo')
                    ->where('admin', '=', 'admin')
                    ->where('uid', '=', $weiboData['id'])
                    ->value('admin');
                if ($admin) {
                    View::share('admin', $admin);
                }
                //分发微博数据模板变量
                View::share([
                    'name' => $weiboData['name'],               //微博昵称
                    'top'  => $weiboData['profile_image_url']    //微博头像
                ]);
            }
        } else {
            //查询登陆的是否是管理员
            $admin = Db::table('blog_weibo')
                ->where('admin', '=', 'admin')
                ->where('uid', '=', session('weibo')['id'])
                ->value('admin');
            if ($admin) {
                View::share('admin', $admin);
            }
            //分发微博数据模板变量
            View::share([
                'name' => session('weibo')['name'],               //微博昵称
                'top'  => session('weibo')['profile_image_url']    //微博头像
            ]);
        }
    }
    //登陆
    public function login()
    {
        if(!isset($_GET['login-index']))
            header('location:/index.html');
//            $this->redirect(url('index/show.Index/index'));
        //+-----------------------------拼接新浪微博第三方登陆url------------------------------------------------------------
        //实例化新浪SDK，传入app_key和app_secret
        $o = new \SaeTOAuthV2(config('ConnectSDK.app_key'), config('ConnectSDK.app_secret'));
        //得到授权页
        $sina_code_url = $o->getAuthorizeURL(config('ConnectSDK.callback_url'));

        //+-----------------------------拼接腾讯QQ第三方登陆url-------------------------------------------------------------
        $qc = new \QC();
        $qq_login_url = $qc->qq_login();

        return view('public/login', ['sina_code_url' => $sina_code_url, 'qq_login_url' => $qq_login_url]);
    }
    //新浪微博api回调
    public function login_sina_callback()
    {
        //-----------设置新浪微博登陆类型------------------------------------------------------------
        session('login_type', 'sina');
        return view('public/login');
    }
    //腾讯qq api回调
    public function login_qq_callback()
    {
        //+---------设置腾讯QQ登陆类型-------------------------------------------------------------
        session('login_type', 'qq');
        return view('public/login');
    }

    //新浪第三方登陆
    public function sinaLogin()
    {

        //实例化新浪SDK，传入app_key和app_secret
        $o = new \SaeTOAuthV2(config('ConnectSDK.app_key'), config('ConnectSDK.app_secret'));
        if (isset($_REQUEST['code'])) {
            $keys                 = array();
            $keys['code']         = $_REQUEST['code'];
            $keys['redirect_uri'] = config('ConnectSDK.callback_url');
            try {
                //取得token信息
                $token = $o->getAccessToken('code', $keys);
            } catch (OAuthException $e) {
            }
        }

        if ($token) {
            //将token存入cookie以及session
            session('token', $token);
            setcookie('weibo_' . $o->client_id, http_build_query($token));
            return 1;
        } else {
            return 0;
        }
    }

    //腾讯qq第三方登陆
    public function qqLogin()
    {
//        dump($_GET);die;
        $qc         = new \QC();
        $token      = $qc->qq_callback();
        $openid     = $qc->get_openid();
        if ($token){
            session('token',$token);
            session('openid',$openid);
            return 1;
        }else{
            return 0;
        }

    }

    //退出登陆
    public function loginOut()
    {
        session(null);
    }

}