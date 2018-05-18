<?php
/**
 * Created by PhpStorm.
 * User: wangyutian
 * Date: 2016/9/14
 * Time: 18:09
 */

class index_IndexController extends BaseController {

    public function listAction() {
        //print_r($this->request->get('bb'));
        //$data = Index_Model_Movie::getInstance()->fetchAll('select * from movie where movieid=:movieid',[':movieid'=>'9']);
        //print_r($data);
		echo Tool::curlGet("http://www.baofeng.com");
        $this->view->name = '我是listAction';
        $this->display('list.html');
    }


}
