<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/7/28
 * Time: 11:15
 */
class Page{
    //总数
    private $total;

    //每页显示的行数
    private $listRows;

    //限制语句
    private $limit;

    //获得uri
    private $uri;

    //当前页数
    private $page;

    //总共页数
    private $pageNum;

    //列表数量
    private $listNum=6;

    //配置
    private $config = array('header'=>'个数据','prev'=>'上一页','next'=>'下一页','first'=>'首页','last'=>'尾页');
    //构造函数
    function __construct($total,$listRows=10){
        $this -> total = $total;
        $this -> listRows = $listRows;
        $this -> uri = $this ->getUri();
        $this -> page = isset($_GET['page']) ?  $_GET['page'] :1;
        $this -> pageNum = ceil($this->total/$this->listRows);
        $this -> limit = $this->setLimit();


    }

    private function setLimit(){
        //limit 从什么位子开始，取几个
        return "limit ".($this->page-1)*$this->listRows.",{$this->listRows}";
    }
    private function getUri(){
        /** 将请求的地址进行连接？
         * 要是有？则添加空白字符
         * 要是没有就添加？
         * 这样后面就能添加？page之类的请求
         */
        $url= $_SERVER['REQUEST_URI'].(strpos($_SERVER['REQUEST_URI'],'?')? '' : '?');
        /**将$url字符串换成localhost query的字符串 并且在这个数组中取出请求
         * 将取到请求的字符串在进行分组分成数组的形式
         * ( [path] => /www/new.php [query] => page=2&name=2&age=99&page=3 )
         */
        $parse=parse_url($url);
        if(isset($parse['query'])){
           /**parse_str（）的第一个参数是传入的字符串必须是page=8&age=45&time=6之类的
            *第二个参数就是将这个字符分组之后的array
            * ( [page] => 2 [age] => 22 [time] => fda )
            */
            parse_str($parse['query'],$params);
            //将page的变量删除
            unset($params['page']);
            /**重新进行分配
             * 将地址栏上面除了page的进行重新组装，并且让其无page这一个请求
             */
            $url = $parse['path'].'?'.http_build_query($params);
        }
        return $url;
    }
    /**
     * @param $args
     * @return null|string
     * __get是在获取私有属性
     * 如果$page = new Page()
     * $page->limit
     * 直接获取私有属性的值，会自动调用__get()方法，返回成员属性的值
     */
    function __get($args){
        if($args == 'limit'){
            return $this ->limit;
        }elseif($args=='uri'){
            return $this->uri;
        }else{
            return null;
        }
    }

    private function star(){
        if($this->total==0)
            return null;
        else
            return ($this->page-1)*$this->listRows+1;
    }

    private function end(){
        //通过比较大小来对其确定
        return min($this->page*$this->listRows,$this->total);
    }

    private function first(){
        $html = '';
        if($this->page==1){
            $html.=' ';
        }else{
            $html.="&nbsp;&nbsp;<a href='{$this->uri}page=1'>{$this->config['first']}</a>&nbsp;&nbsp;";
        }
        return $html;
    }

    private function prev(){
        $html = '';
        $page=$this->page-1;
        if($this->page==1){
            $html.=' ';
        }else{
            $html.="&nbsp;&nbsp;<a href='{$this->uri}page={$page}'>{$this->config['prev']}</a>&nbsp;&nbsp;";
        }
        return $html;
    }

    private function next(){
        $html = '';
        $page=$this->page+1;
        if($this->page==$this->pageNum){
            $html.=' ';
        }else{
            $html.="&nbsp;&nbsp;<a href='{$this->uri}page={$page}'>{$this->config['next']}</a>&nbsp;&nbsp;";
        }
        return $html;
    }

    private function last(){
        $html = '';
        if($this->page==$this->pageNum){
            $html.=' ';
        }else{
            $html.="&nbsp;&nbsp;<a href='{$this->uri}page={$this->pageNum}'>{$this->config['last']}</a>&nbsp;&nbsp;";
        }
        return $html;
    }

    private function gopage(){
        $html='';
        $html.="<input id='num' style='display: inline-block ;width: 50px' type='text' name='num' maxlength='2' value='{$this->page}'><input id='btn' style='display: inline-block' type='submit' value='go'/>";
        return $html;
    }

    private function pagelist(){
        $html='<ol style="display: inline">';
        $half= floor($this->listNum/2);
        for($i =$half;$i>=1;$i-- ){
            $newi =$this->page-$i;
            if($newi <1)
              continue;
                $html .= "<li style='display: inline-block;margin: 10px;border: 1px solid black;width:20px;text-align: center'><a style='text-decoration: none' href='{$this->uri}page={$newi}'>$newi</a></li>";
        }

            $html.= "<li style='display: inline-block;background-color: #50cf7c;margin: 10px;border: 1px solid black;width:20px;text-align: center'><a style='text-decoration: none' href='{$this->uri}page={$this->page}'>$this->page</a></li>";

        for($i =1;$i<=$this->listNum;$i++){
            $newi =$this->page+$i;
            if($newi <$this->pageNum){
                $html .= "<li style='display: inline-block;margin: 10px;border: 1px solid black;width:20px;text-align: center'><a style='text-decoration: none' href='{$this->uri}page={$newi}'>$newi</a></li>";
            }else {
                break;
            }
        }
        $html.='</ol>';
        return $html;
    }

    function fpage(){
        $html = '';
        $html.="&nbsp;&nbsp;共有<b>{$this->total}</b>{$this->config['header']}&nbsp;&nbsp;";
        $html.="&nbsp;&nbsp;每页显示<b>".($this->end()-$this->star()+1)."</b>条,本页<b>{$this->star()}~{$this->end()}</b>条&nbsp;&nbsp;";
        $html.="&nbsp;&nbsp;<b>{$this->page}/{$this->pageNum}</b>页&nbsp;&nbsp;";
        $html.=$this->first();
        $html.=$this->prev();
        $html.=$this->pagelist();
        $html.=$this->next();
        $html.=$this->last();
        $html.=$this->gopage();

        return $html;
    }
}