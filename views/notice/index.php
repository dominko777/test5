<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\NoticeSearch */
/* @var $model app\models\Notice */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Notices');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notice-index">

    <h2><?= Yii::t('app', 'Create notice') ?></h2>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    <h2><?= Html::encode($this->title) ?></h2>

<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'oncreate',
                'format' => ['date', 'php:d/m/Y']
            ],
            'message:ntext',

            [
                    'class' => 'yii\grid\ActionColumn',
                    'template'=>'{delete}',
                    'buttons' => [
                        'delete' => function($url, $data){
                            return Html::a('<button type="button" class="btn btn-labeled btn-danger"><span class="btn-label"><i class="glyphicon glyphicon-trash"></i></span> '
                                . Yii::t('app', 'Remove notice') . '</button>', ['notice/delete', 'id' => $data->id], [
                                'data' => [
                                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                                    'method' => 'post',
                                ],
                            ]);
                        }
                    ]
            ],
        ],
    ]); ?>


<?php Pjax::end(); ?></div>
