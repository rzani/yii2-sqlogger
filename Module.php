<?php

namespace rzani\yii2\sqlogger;

use Yii;
use yii\base\BootstrapInterface;
use yii\base\Event;
use yii\db\ActiveRecord;
use rzani\yii2\sqlogger\Log;

class Module extends \yii\base\Module implements BootstrapInterface
{

    /**
     * @var boolean 
     */
    public $onInsert = true;
    public $onUpdate = true;
    public $onDelete = true;

    public function init()
    {
	$command = null;

	if ($this->onInsert)
	    Event::on(ActiveRecord::className(), ActiveRecord::EVENT_BEFORE_INSERT, function ($event) {
		$db = $event->sender->db;
		$values = $event->sender->getDirtyAttributes();

		$command = $db->createCommand()->insert($event->sender->tableName(), $values)->rawSql;
	    });

	if ($this->onUpdate)
	    Event::on(ActiveRecord::className(), ActiveRecord::EVENT_BEFORE_UPDATE, function ($event) {
		$db = $event->sender->db;
		$values = $event->sender->getDirtyAttributes();
		$condition = $event->sender->getOldPrimaryKey(true);

		$command = $db->createCommand()->update($event->sender->tableName(), $values, $condition)->rawSql;
	    });

	if ($this->onDelete)
	    Event::on(ActiveRecord::className(), ActiveRecord::EVENT_BEFORE_DELETE, function ($event) {
		$db = $event->sender->db;
		$values = $event->sender->getDirtyAttributes();
		$condition = $event->sender->getOldPrimaryKey(true);

		$command = $db->createCommand()->delete($event->sender->tableName(), $condition)->rawSql;
	    });

	Log::save($command);

	return parent::init();
    }

    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'rzani\yii2\sqlogger\controllers';

    public function bootstrap($app)
    {
	if ($app instanceof \yii\web\Application) {
	    $app->getUrlManager()->addRules([
		$this->id => $this->id . '/default/index',
//		$this->id . '/<id:\w+>' => $this->id . '/default/view',
//		$this->id . '/<controller:[\w\-]+>/<action:[\w\-]+>' => $this->id . '/<controller>/<action>',
		    ], false);
	}
    }

    public function beforeAction($action)
    {
	$this->resetGlobalSettings();

	return true;
    }

    /**
     * Resets potentially incompatible global settings done in app config.
     */
    protected function resetGlobalSettings()
    {
	if (Yii::$app instanceof \yii\web\Application) {
	    Yii::$app->assetManager->bundles = [];
	}
    }

}
