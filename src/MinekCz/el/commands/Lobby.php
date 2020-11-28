<?php

namespace MinekCz\el\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginIdentifiableCommand;
use pocketmine\Player;
use pocketmine\plugin\Plugin;
use MinekCz\el\Main;

class Lobby extends Command implements PluginIdentifiableCommand {
    
    public $plugin;
    public $config;
    
    public function __construct(Main $plugin) {
        $this->plugin = $plugin;
        $this->config = $this->plugin->ConfigManager;
        parent::__construct("lobby", $this->config->get("command-description"), \null, ["spawn" , "hub", "mainlobby", "mainhub", "hubtp", "lobbytp"]);
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {

        if(!isset($args[0])) {
            /** @var Player $sender */
            $this->plugin->teleport($sender);
            $sender->sendMessage($this->config->get("lobby-tp"));
            return;
        }
        switch ($args[0]) {
            default:
                if(!$sender->hasPermission($this->config->get("perm"))) {
                    $sender->sendMessage($this->config->get("noperm"));
                    break;
                }
                $player = $this->plugin->getServer()->getPlayer($args[0]);
                if ($player !== NULL) {
                    $this->plugin->teleport($player);
                    $player->sendMessage($this->config->get("lobby-tp"));
                } else {
                    /** @var Player $sender */
                    $this->plugin->teleport($sender);
                    $sender->sendMessage($this->config->get("lobby-tp"));
                }
                break;
        }

    }

    public function getPlugin(): Plugin {
        return $this->plugin;
    }
}