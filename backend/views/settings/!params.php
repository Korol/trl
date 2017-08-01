<?php
use yii\helpers\Html;
use  yii\data\ActiveDataProvider;

// In your view
use yii\grid\GridView;
use yii\widgets\Pjax;



/*
use sammaye\mailchimp\Mailchimp;
$mc = new sammaye\mailchimp\Mailchimp(['apikey' => '4515f9360ad9385c44c0acb9d1ef3869-us10']);
$yourArray=$mc->lists->getList();
print_r($yourArray);
*/

/* @var $this yii\web\View */
$this->title = 'Параметри';
$this->params['breadcrumbs'][] = '';
?>
<div class="site-about">

    <h1><?= Html::encode($this->title) ?></h1>

<?php


Pjax::begin();

GridView::widget(
	[
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
			'id',
			[
				'class' => '\pheme\grid\ToggleColumn',
				'attribute' => 'active',
				// Uncomment if  you don't want AJAX
				// 'enableAjax' => false,
			],
			['class' => 'yii\grid\ActionColumn'],
		],
	]
);

Pjax::end();


?>





</div>









 
