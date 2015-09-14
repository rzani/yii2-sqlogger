<?php

namespace rzani\yii2\sqlogger;

use yii\web\AssetBundle;

/**
 * This declares the asset files required by SQLogger.
 *
 * @author Rodrigo Zani <rodrigo.zhs@gmail.com>
 */
class Assets extends AssetBundle
{

    public $sourcePath = '@vendor/rzani/yii2-sqlogger/Assets';
    public $css = [
	'main.css',
    ];
    public $depends = [
	'yii\web\YiiAsset',
	'yii\bootstrap\BootstrapAsset',
	'yii\bootstrap\BootstrapPluginAsset',
	'yii\gii\TypeAheadAsset',
    ];

}
