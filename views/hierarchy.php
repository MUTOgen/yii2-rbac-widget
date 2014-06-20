<?php
/**
 * Author: Abramov A. aka MUTOgen
 *
 * @var \yii\rbac\BaseManager $auth
 */
?>

<div class="widget">
    <div class="widget-body form">

        <ul class="nav nav-tabs">
            <li class="active"><a href="#rights-check" data-toggle="tab"><?=Yii::t('app/rbacw','Permissions List')?></a></li>
            <li><a href="#rights-tree" data-toggle="tab"><?=Yii::t('app/rbacw','Permissions Tree')?></a></li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane active" id="rights-check">
                <table class="table table-condensed">
                    <tr><th><?=Yii::t('app/rbacw','User')?></th><th><?=Yii::t('app/rbacw','ID')?>: <?= $this->userId?></th><th></th></tr>
                    <tr><th colspan="3"><?=Yii::t('app/rbacw','Permissions')?></th></tr>
                    <?php foreach($auth->getPermissions() as $i):?>
                        <tr>
                            <td><?= $i->name ?></td>
                            <td><?= $i->description ?></td>
                            <td>
                                <?php if($auth->checkAccess($this->userId,$i->name)): ?>
                                    <i class="icon-ok"></i>
                                <?php else: ?>
                                    <i class="icon-check-empty"></i>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach;?>
                    <tr><th colspan="3"><?=Yii::t('app/rbacw','Roles')?></th></tr>
                    <?php foreach($auth->getRoles() as $i):?>
                        <tr>
                            <td><?= $i->name ?></td>
                            <td><?= $i->description ?></td>
                            <td>
                                <?php if($auth->checkAccess($this->userId,$i->name)): ?>
                                    <i class="icon-ok"></i>
                                <?php else: ?>
                                    <i class="icon-check-empty"></i>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach;?>
                </table>
            </div>

            <div class="tab-pane" id="rights-tree">
                <?php foreach($auth->getRoles() as $role): ?>
                    <b><?=Yii::t('app/rbacw','Role')?> <?= $role->name?></b><br/>
                    <?php
                        $childs = $auth->getChildren($role->name);
                        echo $this->_recursiveList($childs,1);
                    ?>
                    <br/>
                <?php endforeach;?>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('.popoverHandler').popover({
            trigger: 'hover'
        });
    });
</script>