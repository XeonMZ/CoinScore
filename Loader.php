<?php
declare(strict_types = 1);

namespace aero\CoinScore;

use aero\CoinScore\listeners\EventListener;
use aero\CoinScore\listeners\TagResolveListener;
use pocketmine\plugin\PluginBase;

class Loader extends PluginBase{

	protected function onEnable(): void{
		$this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
		$this->getServer()->getPluginManager()->registerEvents(new TagResolveListener($this), $this);
	}
}