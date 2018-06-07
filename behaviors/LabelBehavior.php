<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 07.06.2018
 * Time: 16:28
 */

namespace app\behaviors;


use Yii;
use yii\base\Behavior;
use yii\base\Event;
use yii\db\ActiveRecord;

class LabelBehavior extends Behavior
{

	public $attribute = 'labels';

	public function events()
	{
		return [
			ActiveRecord::EVENT_AFTER_FIND => 'onAfterFind',
			ActiveRecord::EVENT_BEFORE_INSERT => 'onBeforeSave',
			ActiveRecord::EVENT_BEFORE_UPDATE => 'onBeforeSave',
		];
	}

	public function onAfterFind(Event $event)
	{
		$labelComponent = $this->getLabelComponent();
		$deal = $event->sender;
		if ($labelComponent) {
			$deal->{$this->attribute} = implode(',', $labelComponent->findById($deal->id));
		}
	}

	public function onBeforeSave(Event $event)
	{
		$labelComponent = $this->getLabelComponent();
		$deal = $event->sender;
		if ($labelComponent) {
			$labelComponent->removeById($deal->id);
			foreach (explode(',', $deal->labels) as $label) {
				$labelComponent->actionAssign($deal->id, $label);
			}
		}
	}

	private function getLabelComponent()
	{
		return Yii::$app->get('labels', false);
	}

}