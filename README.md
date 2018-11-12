[![Latest Stable Version](https://poser.pugx.org/zacksleo/yii2-ad/version)](https://packagist.org/packages/zacksleo/yii2-ad)
[![Total Downloads](https://poser.pugx.org/zacksleo/yii2-ad/downloads)](https://packagist.org/packages/zacksleo/yii2-ad)
[![License](https://poser.pugx.org/zacksleo/yii2-ad/license)](https://packagist.org/packages/zacksleo/yii2-ad)
[![Build Status](https://travis-ci.org/zacksleo/yii2-ad.svg?branch=master)](https://travis-ci.org/zacksleo/yii2-ad)
[![StyleCI](https://styleci.io/repos/82318907/shield?branch=master)](https://styleci.io/repos/82318907)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/zacksleo/yii2-ad/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/zacksleo/yii2-ad/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/zacksleo/yii2-ad/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/zacksleo/yii2-ad/?branch=master)
# yii2 ad module

# Prerequisites

Install [Yii2 attachments](https://github.com/Nemmo/yii2-attachments) first

## Migration

+ Config Migration Path  in Yii config file like this

```
    'controllerMap' => [
        'migrate' => [
            'class' => 'yii\console\controllers\MigrateController',
            'migrationPath' => [
                ...
                '@zacksleo/yii2/ad/migrations',
            ],
        ],
    ],

```

+ Or run migration by By migrationPath Parameter

```
  ./yii migrate --migrationPath=@zacksleo/yii2/ad/migrations

```

## Config Module in components part

```
    'rom-release' => [
        'class' => 'zacksleo\yii2\ad\Module',
    ]

```

## Use Actions

```
class AdController extends Controller
{
    public function actions()
    {
        return [
            'index' => [
                'class' => 'zacksleo\yii2\ad\actions\IndexAction'
            ]
        ];
    }
}
```