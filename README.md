此框架主要是为了提供常用的简单功能，代码速度等快速开发的需要而定制，功能包括：

### 环境配置
	测试环境：在nginx的fastcgi.conf中配置 ENV=dev
### 路由选择,nginx配置
	location / {
		if ( !-f $request_filename ) {
			rewrite ^/(.*) /index.php?$1;
		}
	}
### 参数
	a). cli方式:
		php index.php module controller action [env=dev]
	b). url方式：
		/module/controller/action/[othername/othervalue]
		如：/index/index/list/env/1  => module=index,controller=index,action=list,env=1
	c). (在controller)获得参数：
		c_1). $this->request->get($paramName,''); => 如： $this->request->get('env');
		c_2). $this->request->gets(); //获得所有参数;
### 自动加载
		php composer.phar install
### 数据库操作
		a). model/ 目录新建相应的model文件，例如：
			a_1). model/Movie.php => class Index_Model_Movie
			a_2). Index_Model_Movie::getInstance()->fetchAll($sql);
		b). fetchAll,fetch, execute, update等方法
					
### 模板引擎
		$this->display('list.html');
### 配置管理
	a). env=dev 会加载配置文件为 config/ 目录下的 _dev后缀的文件，如:base_dev.php
	b). $this->_request->getConfig($filename,$field);
		//$filename是config目录下的配置文件名,config/base.php => $this->_request->getConfig('base');
		$this->_request->getConfig(); //默认是base.php文件配置
		//base.php文件中的字段为db的配置
		$this->_request->getConfig('base','db');
	 
### 日志管理
	Log::getInstance($path)->write($str);
	
### MVC
	modules/目录下，每个模块一个文件夹，如 index/{controller},{model},{view}

### 后台登录
	a). 在confg/base.php中开启 'auth' => 'on', 有登录功能，数据验证需要自己在controller中实现登录，成功验证需要调用：
	     Auth::success($this->request,$data); 即可 $data参数具体根据auth.php中的cookie参数来设置字段
	b). 取得用户信息： $this->request->user();
	c). 用户退出： Auth::success($this->request, [], 1);
	
此框架主要是为了提供常用的简单功能，代码速度等快速开发的需要而定制
