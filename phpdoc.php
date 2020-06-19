<?php
/**
 * Class Yii
 */
class Yii extends \yii\BaseYii
{
    /**
     * @var BaseApplication|WebApplication|ConsoleApplication the application instance
     */
    public static $app;
}

/**
 * @property yii\caching\FileCache $cache
 * @property yii\rbac\DbManager $authManager
 * @property yii\db\Connection $db
 * @property \app\components\User $user
 **/
abstract class BaseApplication extends yii\base\Application
{
}

class WebApplication extends yii\web\Application
{
}

class ConsoleApplication extends yii\console\Application
{
}
