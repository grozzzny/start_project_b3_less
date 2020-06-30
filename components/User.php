<?php


namespace app\components;


use app\models\Locations;

/**
 * Class User
 * @package app\components
 * @property \app\models\User $identity
 * @property-read integer $cookieLocationId
 * @property-read Locations $selectedLocation
 *
 */
class User extends \yii\web\User
{

}
