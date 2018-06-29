<?php

use backend\assets\AppAsset;
use \yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use kartik\growl\Growl;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
          .header img{
            margin-left: 10px;
            float: left;
            width: 70px;
            height: 70px;
          }
          .header h1{
            font-size: 25px;
            position: relative;
            top: 20px;
            left: 10px;
          }
        </style>
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <div class="header">
        <img src="../views/layouts/logodel.png" alt="logo" />
        <h1>Sistem Cuti Karyawan</h1><br><br>
    </div>
    <body>
        <?php $this->beginBody() ?>
        <div class="wrap">
            <?php
            NavBar::begin([
                // 'brandLabel' => '',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse',
                ],
            ]);

            if (Yii::$app->user->isGuest) {
                // return Yii::$app->getResponse()->redirect(array(Url::to(['site/login'],302)));
                $menuItems = [
                    ['label' => 'Home', 'url' => ['/siti/default/index']],
                    ['label' => 'Aturan', 'items' => [
                            ['label' => 'Aturan Cuti', 'url' => ['/siti/default/cuti']],
                            ['label' => 'Aturan Izin', 'url' => ['/siti/default/izin']],
                        ]],
                    ['label' => 'Jenis', 'items' => [
                            ['label' => 'Jenis Cuti', 'url' => ['/siti/trjenis-cuti']],
                            ['label' => 'Jenis Izin', 'url' => ['/siti/trjenis-izin']],
                        ]],
                ];
                $menuItems2 = [
                    ['label' => 'Login', 'url' => ['/siti/default/login']],
                ];
            }


            if (!Yii::$app->user->isGuest) {
                $menuItems = [
                    ['label' => 'Home', 'url' => ['/siti/default/index']],
                    ['label' => 'Riwayat Cuti/Izin', 'items' => [
                            ['label' => 'Lihat Riwayat Cuti', 'url' => ['/siti/tpermohonan-cuti/lihatriwayat']],
                            ['label' => 'Lihat Riwayat Izin', 'url' => ['/siti/tpermohonan-izin/lihatriwayat']],
                        ]],
                    ['label' => 'Ajukan', 'items' => [
                            ['label' => 'Request Cuti', 'url' => ['/siti/tpermohonan-cuti/create']],
                            ['label' => 'Request Izin', 'url' => ['/siti/tpermohonan-izin/create']],
                        ]],
                ];
                $menuItems2 = [
                  ['label' => 'Notifikasi',
                   'items' => [
                        ['label' => 'Notifikasi pengajuan cuti', 'url' => ['/siti/tpermohonan-cuti/']],
                        ['label' => 'Notifikasi pengajuan izin', 'url' => ['/siti/tpermohonan-izin/']],
                   ],
                 ],
                  ['label' => '' . Yii::$app->user->identity->username . '',
                   'items' => [
                        ['label' => 'Profil', 'url' => ['/siti/tkaryawan/profil/', 'id' =>Yii::$app->user->id]],
                         '<li class="divider"></li>',
                        ['label' => 'Logout',
                         'url' => ['/site/logout'],
                         'linkOptions' => ['data-method'=>'post'],
                        ],
                        ],
                    ],
                ];
            }

            if (Yii::$app->user->id==1) {
                $menuItems = [
                    ['label' => 'Home', 'url' => ['/siti/default/index']],
                    ['label' => 'Daftar Request', 'items' => [
                        ['label' => 'Kelola Cuti', 'url' => ['/siti/tpermohonan-cuti/']],
                        ['label' => 'Kelola Izin', 'url' => ['/siti/tpermohonan-izin/']],
                    ]],
                    ['label' => 'Karyawan', 'url' => ['/siti/tkaryawan/']],
              ];
              $menuItems2 = [
                ['label' => 'Notifikasi',
                 'items' => [
                      ['label' => 'Notifikasi pengajuan cuti', 'url' => ['/siti/tpermohonan-cuti/']],
                      ['label' => 'Notifikasi pengajuan izin', 'url' => ['/siti/tpermohonan-izin/']],
                 ],
               ],
                [
                    'label' => '' . Yii::$app->user->identity->username . '',
                    'items' => [
                         ['label' => 'Profil', 'url' => ['/siti/tkaryawan/view/', 'id' =>Yii::$app->user->id]],
                         '<li class="divider"></li>',
                         ['label' => 'Logout',
                         'url' => ['/site/logout'],
                         'linkOptions' => ['data-method'=>'post'],
                          ],
                      ],
                  ],
              ];
        //       echo Nav::widget([
        // // 'items' = MenuHelper::getAssignedMenu(Yii::$app->user->id);
        // 'items' => [
        //     [
        //         'label' => '' . Yii::$app->user->identity->username . '',
        //         'items' => [
        //              ['label' => 'Profil', 'url' => '#'],
        //              '<li class="divider"></li>',
        //              ['label' => 'Logout',
        //              'url' => ['/site/logout'],
        //              'linkOptions' => ['data-method'=>'post'],
        //             ],
        //         ],
        //     ],
        // ],
        // 'options' => ['class' =>'navbar-nav navbar-right'],
        // ]);
        }
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-left'],
                'items' => $menuItems,
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems2,
            ]);
            NavBar::end();
            ?>

            <div class="container">
                <?=
                Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ])
                ?>
                <?= $content ?>
            </div>
        </div>

        <footer class="footer">
            <div class="container">
                <p class="pull-left">&copy; PSI-08 <?= date('d-m-Y') ?></p>
                <p class="pull-right"><?= Yii::powered() ?></p>
            </div>
        </footer>

        <?php $this->endBody() ?>


    </body>
</html>
<?php $this->endPage() ?>
