<?php echo $this->Html->css('mypage', null, array('inline' => false)) ?>
<?php echo $this->Html->css('grid', null, array('inline' => false)) ?>
<?php echo $this->Html->script('grid_position', array('inline' => false)) ?>

<?php echo $this->element('message/menu', array('mode' => 'send')) ?>

    <h4><span class="el-icon-envelope"></span> メッセージを送る</h4>

<?php echo $this->element('message/send_menu', array('mode' => 'created')) ?>

    <br>
<?php if(!empty($projects)): ?>
    <div class="grid_container clearfix">
        <?php foreach($projects as $project): ?>
            <?php echo $this->element('project_box/project_box_for_message_created', compact('project')) ?>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <div class="container">
        <p>まだ作成して成功したプロジェクトはありません</p>
    </div>
<?php endif; ?>


<?php $this->start('script') ?>
    <script>
        $(document).ready(function () {
            all_grid_position();
        });
    </script>
<?php $this->end() ?>