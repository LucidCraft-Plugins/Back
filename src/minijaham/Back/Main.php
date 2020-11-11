<?php
namespace minijaham\Back;
use minijaham\Back\Commands\Back;
use minijaham\Back\EventListener;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat as C;
class Main extends PluginBase implements Listener {
    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
        $this->getServer()->getCommandMap()->register("back", new Back($this));
    }
}