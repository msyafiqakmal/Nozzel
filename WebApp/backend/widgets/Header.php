<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 11/9/2017
 * Time: 7:28 PM
 */

namespace backend\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\ArrayHelper;


class Header extends Widget
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
    }

    public function run()
    {

        return $this->render('header');
    }
}