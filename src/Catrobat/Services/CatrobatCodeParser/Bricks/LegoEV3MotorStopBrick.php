<?php

namespace App\Catrobat\Services\CatrobatCodeParser\Bricks;

use App\Catrobat\Services\CatrobatCodeParser\Constants;

class LegoEV3MotorStopBrick extends Brick
{
  protected function create(): void
  {
    $this->type = Constants::LEGO_EV3_MOTOR_STOP_BRICK;
    $this->caption = 'Stop EV3 motor';
    $this->setImgFile(Constants::LEGO_EV3_BRICK_IMG);
  }
}
