<?php
class PageLinkWidget extends CWidget
{
    public $url;
    public $pager;
    public function init()
    {
        parent::init();
    }
    public function run()
    {
        $url = $this->url;
        $pager = $this->pager;
        $this->render('pagelink', compact('url','pager'));
    }
}
?>