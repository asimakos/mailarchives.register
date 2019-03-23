<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use app\models\Employee;
use app\models\Document;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;

$users=Employee::find()->all();
$docs=Document::find()->all();

?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        This is the About page. You may modify the following file to customize its content: <?php echo count($users); ?> χρήστες <br/>
        Πλήθος <?php echo count($docs); ?> εγγράφων 
    </p>

    <code><?= __FILE__ ?></code>
</div>
