<?php if (!empty($pager)) :?>
    <?php $page_count = ceil($pager->itemCount/$pager->pageSize); //ceil()向上舍去求整，例如ceil(0.3),运行结果是1?>
    <?php if ($page_count> 1&&$page_count<11) :?>
        <div class="pages">
            <div class="page_num">
                <?php if ($pager->currentPage>0): ?>
                    <a href="<?php echo $url?>page_size/<?php echo $pager->pageSize ?>/page/1" class="page_first">首页</a>
                <?php endif;?>
                <?php if ($pager->currentPage-1>0): ?>
                    <a title="上一页" href="<?php echo $url ?>page_size/<?php echo $pager->pageSize ?>/page/<?php $pager->currentPage ?>" class="prevpage"></a>
                <?php endif?>
                <?php for ($i=1;$i<=$page_count;$i++) :?>
                    <?php if ($i-1==$pager->currentPage) :?>
                        <span><?php echo $i ?></span>
                    <?php else:?>
                        <a href="<?php echo $url ?>page_size/<?php echo $pager->pageSize ?>/page/<?php echo $i ?>"><?php echo $i ?></a>
                    <?php endif;?>
                <?php endfor; ?>
                <?php if ($pager->currentPage+1<$page_count): ?>
                    <a title="下一页" href="<?php echo $url ?>page_size/<?php echo $pager->pageSize ?>/page/<?php echo $pager->currentPage+2 ?>" class="nextpage"></a>
                    <a href="<?php echo $url ?>page_size/<?php echo $pager->pageSize ?>/page/<?php echo $pager->page_count ?>" class="page_end">末页</a>
                <?php endif;?>
            </div>
        </div>
    <?php else:?>
        <?php if ($page_count>1): ?>
        <div class="pages">
            <div class="page_num">
                <?php if ($pager->currentPage>0): ?>
                    <a href="<?php echo $url ?>page_size/<?php echo $pager->pageSize ?>/page/1">首页</a>
                <?php endif; ?>
                <?php if ($pager->currentPage-1>0): ?>
                    <a title="上一页" href="<?php echo $url ?>page_size/<?php echo $pager->pageSize ?>/page/<?php echo $pager->currentPage ?>"></a>
                <?php endif;?>
                <?php for ($i=1;$i<$page_count;$i++) :?>
                    <?php if ($pager->currentPage<6 && $i<11): ?>
                        <?php if ($i-1==$pager->currentPage) :?>
                            <span><?php echo $i ?></span>
                        <?php else:?>
                            <a href="<?php echo $url ?>page_size/<?php echo $pager->pageSize ?>/page/<?php echo $i ?>"><?php echo $i ?></a>
                        <?php endif;?>
                    <?php else: ?>
                        <?php if ($i-1<$pager->currentPage+5 && $i-1>$pager->currentPage-5): ?>
                            <?php if ($i-1==$pager->currentPage) :?>
                                <span><?php echo $i?></span>
                            <?php else: ?>
                                <a href="<?php echo $url?>page_size/<?php echo $pager->pageSize ?>/page/<?php echo $i ?>"><?php echo $i ?></a>
                            <?php endif; ?>
                        <?php endif;?>
                    <?php endif;?>
                <?php endfor;?>
                <?php if ($pager->currentPage+1<$page_count): ?>
                    <a title="下一页" href="<?php echo $url ?>page_size/<?php echo $pager->pageSize ?>/page/<?php echo $pager->currentPage+2 ?>" class="nextpage"></a>
                    <a href="<?php echo $url ?>page_size/<?php echo $pager->pageSize ?>/page/<?php echo $page_count ?>" class="page_end">末页</a>
                <?php endif;?>
            </div>
        </div>
        <?php endif;?>
    <?php endif;?>
<?php endif; ?>