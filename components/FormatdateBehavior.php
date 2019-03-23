<?php

namespace app\components;
use yii\base\Behavior;
use yii\db\ActiveRecord;
   
   class FormatdateBehavior extends Behavior {
	   
      public function events() {
         return [
            ActiveRecord::EVENT_BEFORE_INSERT => 'before_dateformat',
            ActiveRecord::EVENT_BEFORE_UPDATE => 'before_dateformat',
         ];
      }
      
      public function before_dateformat($event) {
         $this->owner->registry_date = date('Y-m-d', strtotime($this->owner->registry_date));
     }
   }

?>
