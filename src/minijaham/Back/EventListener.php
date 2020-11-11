<?php

namespace minijaham\Back;

use minijaham\Back\Main;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\utils\Config;

class EventListener implements Listener {

    /** @var Main $plugin */
    private $plugin;

    public function __construct(Main $plugin){
        $this->plugin = $plugin;
    }
    public function playerDeath(PlayerDeathEvent $ev){
        $player = $ev->getPlayer();
        $config = new Config($this->plugin->getDataFolder() . "Backs.yml", Config::YAML);
        $config->set($player->getName(), "{$player->getX()}_{$player->getY()}_{$player->getZ()}_{$player->getLevel()->getName()}");
        $config->save();
    }
    public function playerQuit(PlayerQuitEvent $ev){
        $player = $ev->getPlayer();
        $config = new Config($this->plugin->getDataFolder() . "Backs.yml", Config::YAML);
        if ($config->exists($player->getName())){
            $config->remove($player->getName());
            $config->save();
        }
    }
}