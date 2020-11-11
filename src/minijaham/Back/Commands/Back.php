<?php

namespace minijaham\Back\Commands;

use minijaham\Back\Main;
use pocketmine\Player;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;
use pocketmine\level\Position;
use pocketmine\utils\Config;

class Back extends PluginCommand{
    /** @var Main $plugin */
    private $plugin;

    public function __construct(Main $plugin){
        parent::__construct("back", $plugin);
        $this->setDescription("Teleport to your previous death position");
        $this->plugin = $plugin;
    }
	
    public function execute(CommandSender $player, string $commandLabel, array $args){
        $config = new Config($this->plugin->getDataFolder() . "Backs.yml", Config::YAML);
		if ($player instanceof Player){
			if ($player->hasPermission("back.cmd")) {
				if ($config->exists($player->getName())){
					$position = explode("_", $config->get($player->getName()));
					$x = (int)$position[0];
					$y = (int)$position[1];
					$z = (int)$position[2];
					$world = $this->plugin->getServer()->getLevelByName($position[3]);
					$player->teleport(new Position($x, $y, $z, $world));
					$player->sendMessage("§7(§a!§7) §aSuccessfully teleported to your last death position");
					$player->addTitle("§aSuccess!");
				} else {
					$player->sendMessage("§7(§c!§7) §cYou have to die first to teleport");
				}
			} else {
				$player->sendMessage("§cYou do not have permission to use this command!");
			}
		} else {
			$this->plugin->getLogger()->info("§7(§c!§7) §cYou can only execute this command from console.");
        }
    }
}
