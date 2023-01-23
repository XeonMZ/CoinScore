<?php
declare(strict_types = 1);

namespace aero\CoinScore\listeners;

use aero\CoinScore\Loader;
use Ifera\ScoreHud\event\PlayerTagUpdateEvent;
use Ifera\ScoreHud\scoreboard\ScoreTag;
use onebone\coinapi\event\coin\CoinChangedEvent;
use pocketmine\event\Listener;
use pocketmine\player\Player;
use function is_null;

class EventListener implements Listener{

	/** @var Loader */
	private $plugin;

	public function __construct(Loader $plugin){
		$this->plugin = $plugin;
	}

	public function onCoinChange(CoinChangedEvent $event){
		$username = $event->getUsername();

		if(is_null($username)){
			return;
		}

		$player = $this->plugin->getServer()->getPlayerByPrefix($username);

		if($player instanceof Player && $player->isOnline()){
			(new PlayerTagUpdateEvent($player, new ScoreTag("coin.aero", (string) $event->getCoin())))->call();
		}
	}
}