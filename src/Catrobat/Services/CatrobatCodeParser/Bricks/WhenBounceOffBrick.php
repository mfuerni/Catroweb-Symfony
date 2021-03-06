<?php

namespace App\Catrobat\Services\CatrobatCodeParser\Bricks;

use App\Catrobat\Services\CatrobatCodeParser\Constants;
use App\Catrobat\Services\CatrobatCodeParser\Scripts\Script;

class WhenBounceOffBrick extends Script
{
  protected function create(): void
  {
    $this->type = Constants::WHEN_BOUNCE_OFF_BRICK;
    $this->caption = 'When you bounce off';
    $this->setImgFile(Constants::MOTION_SCRIPT_IMG);
  }
}
