<?php

namespace App\Catrobat\Services\CatrobatCodeParser\Bricks;

use App\Catrobat\Services\CatrobatCodeParser\Constants;

class PlaySoundWaitBrick extends Brick
{
  protected function create(): void
  {
    $this->type = Constants::PLAY_SOUND_WAIT_BRICK;
    $this->caption = 'Start sound and wait';
    $this->setImgFile(Constants::SOUND_BRICK_IMG);
  }
}
