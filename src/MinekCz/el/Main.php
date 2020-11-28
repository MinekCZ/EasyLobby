<?php

declare(strict_types = 1);

namespace MinekCz\el;

use pocketmine\event\Listener;
use pocketmine\Player;
use pocketmine\plugin\PluginBase as Plugin;
use pocketmine\math\Vector3;
use MinekCz\el\commands\Lobby;
use MinekCz\el\commands\EasyLobby;

class Main extends Plugin implements Listener {

    //Managers
    public $ConfigManager;
  
    public $config;
  
    public function onEnable(): void {
        // Managers
        $this->ConfigManager = new ConfigManager($this);
        $this->getServer()->getCommandMap()->registerAll("EasyLobby", [new EasyLobby($this), new Lobby($this)]);
  
        $this->getConfig()->save();
  
        $this->config = $this->ConfigManager;
    }

    public function playerLevel(Player $player) :string {
        return $player->getLevel()->getFolderName();
    }

    public function teleport(Player $player) {
        $position = $this->config->getArray("lobby");
        $x = $position[0];
        $y = $position[1];
        $z = $position[2]; 
        if(!$this->getServer()->isLevelLoaded($position[3])) $this->getServer()->loadLevel($position[3]);
        $level = $this->getServer()->getLevelByName($position[3]);  
        $player->teleport($level->getSafeSpawn());
        $player->teleport(new Vector3($x, $y, $z));  
    }
}