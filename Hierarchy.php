<?php
/**
 * Author: Abramov A. aka MUTOgen
 *
 * Widget helps you to see whole rbac hierarchy by each role and see hierarchy for current user
 * Place it wherever you want
 *
 */

namespace mutogen\rbacw;

class Hierarchy extends \yii\base\Widget
{
    /**
     * User's id to display permission list
     * @var null
     */
    public $userId = null;

    /**
     * Full class name of User model
     * @var string
     */
    public $class = 'app\models\User';


    /**
     * Run this widget
     * @return string|void
     */
    public function run()
    {
        //if no userId specified, let's see permissions of the current user
        if ($this->userId === null) $this->userId = \Yii::$app->user->identity->getId();

        $this->render('hierarchy',array(
                'auth' => \Yii::$app->authManager,
            ));
    }

    /**
     * Format output string for recursive list
     *
     * @param $item
     * @return string
     */
    protected function _formatItem($item){
        /**
         * @var \yii\rbac\Item $item
         */
        switch ($item->type) {
            case 2:
                $tag  = 'u';
                $name = \Yii::t('app/rbacw','Permission');
                break;
            case 1:
                $tag  = 'b';
                $name = \Yii::t('app/rbacw','Role');
                break;
            default:
                $tag  = 'span';
                $name = '?';
                break;
        }

        return sprintf('<%s class="popoverHandler" data-content="%s" data-title="%s: %s">%s: %s (%s)</%s>',
            $tag,$item->description,$name,$item->name,$name,$item->name,$item->description,$tag);
    }

    /**
     * Generate recursive list or roles and permissions
     *
     * @param $items
     * @param $level
     * @return string
     */

    protected function _recursiveList($items,$level)
    {
        $out = '';
        $auth = \Yii::$app->authManager;

        if ($level > 100) die('Too Deep Recursion');

        if(is_array($items) && count($items) > 0){
            foreach($items as $i){
                $out .= str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $level);
                $out .= $this->_formatItem($i);
                $out .= '<br/>';
                $childs = $auth->getChildren($i->name);
                $out.= $this->_recursiveList($childs, $level+1);
            }
        } else {
            return '';
        }

        return $out;
    }


}
