<?php
/**
 * Created by 信磊.
 * Date: 2017/9/1
 * Time: 16:03
 */

namespace app\admin\model;


use think\Db;

class Index extends BaseModel
{
    //管理员首页网站信息
    public function showInfo(){
        //----------------------------------登陆信息-------------------------------------------------------
        $loginInfo = Db::table('blog_user')
            ->where('id','=',session('id'))
            ->find();                                   //取一条已登陆的数据
        $showInfo['ip'] = $loginInfo['login_ip'];              //本次登陆IP
        $showInfo['city'] = $this->getIPByCity($showInfo['ip']);            //ip所在城市
        $showInfo['time'] = date('Y-m-d H:i',$loginInfo['login_time']);     //本次登陆时间

        //----------------------------------统计信息--------------------------------------------------------
        $showInfo['userCount'] = Db::table('blog_user')->count();           //用户总数
        $showInfo['todayLogin'] = Db::table('blog_user')                    //今日登陆
            ->whereTime('login_time','today')
            ->field('id')
            ->count();
        $showInfo['articleCount'] = Db::table('blog_article')               //文章总数
            ->where('delete',null)
            ->whereOr('delete','')
            ->field('id')
            ->count();
        $showInfo['resourceCount'] = Db::table('blog_resource')               //资源总数
            ->where('delete',null)
            ->whereOr('delete','')
            ->field('id')
            ->count();
        $showInfo['messageCount'] = Db::table('blog_message')               //留言总数（不含回复）
            ->where('pid',0)
            ->field('id')
            ->count();
        $showInfo['server_info'] = $this->server_info();                          //系统参数
        return $showInfo;
    }

    /**
     * @ip 当前用户所在ip
     * @return 数组对象
     */
    public function getIPByCity($ip){
        if($ip == "127.0.0.1" || $ip == "0.0.0.0") {
            return '广西壮族自治区南宁市';
        }
        $host = "https://dm-81.data.aliyun.com";
        $path = "/rest/160601/ip/getIpInfo.json";
        $method = "GET";
        $appcode = "d75b1853172a40069cd10070358d44e9";
        $headers = array();
        array_push($headers, "Authorization:APPCODE " . $appcode);
        $querys = "ip=" . $ip;
        $bodys = "";
        $url = $host . $path . "?" . $querys;

        $curl = curl_init();
        //设置请求方式
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        //设置url
        curl_setopt($curl, CURLOPT_URL, $url);
        //设置自定义HTTP标头
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        //默认是否返回失败错误
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        //设置成功是否只返回结果，不自动输出
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        //设置是否返回请求头信息
        curl_setopt($curl, CURLOPT_HEADER, false);
        //判断是否https加密通道
        if(1 == strpos("$" . $host, "https://")){
            //跳过ssl证书验证
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        $data = json_decode(curl_exec($curl));
        //拼接省市
        return $data->data->region . $data->data->city;
    }

    //系统参数
    public function server_info(){
        $info = array(
            '操作系统'=>PHP_OS,
            '运行环境'=>$_SERVER["SERVER_SOFTWARE"],
            '主机名'=>$_SERVER['SERVER_NAME'],
            'WEB服务端口'=>$_SERVER['SERVER_PORT'],
            '网站文档目录'=>$_SERVER["DOCUMENT_ROOT"],
            '浏览器信息'=>substr($_SERVER['HTTP_USER_AGENT'], 0, 40),
            '通信协议'=>$_SERVER['SERVER_PROTOCOL'],
            '请求方法'=>$_SERVER['REQUEST_METHOD'],
            'ThinkPHP版本'=>THINK_VERSION,
            '上传附件限制'=>ini_get('upload_max_filesize'),
            '执行时间限制'=>ini_get('max_execution_time').'秒',
            '服务器时间'=>date("Y年n月j日 H:i:s"),
            '北京时间'=>gmdate("Y年n月j日 H:i:s",time()+8*3600),
            '服务器域名/IP'=>$_SERVER['SERVER_NAME'].' [ '.gethostbyname($_SERVER['SERVER_NAME']).' ]',
            '用户的IP地址'=>$_SERVER['REMOTE_ADDR'],
            '剩余空间'=>round((disk_free_space(".")/(1024*1024)),2).'M',
        );
         return $info;
    }
}