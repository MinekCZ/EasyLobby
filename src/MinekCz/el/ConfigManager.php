<?php

namespace MinekCz\el;

use pocketmine\event\Listener;

class ConfigManager implements Listener {

  public $plugin;
  public $config;

  public function __construct(Main $plugin) {
    $this->plugin = $plugin;
    $this->config = $this->plugin->getConfig();
  }

  public function set(string $type, string $new) {
    $this->config->set($type, $new);
    $this->config->save();
  }

  public function setArray(string $type, array $new) {
    $this->config->set($type, $new);
    $this->config->save();
  }

  public function setInt(string $type, int $new) {
    $this->config->set($type, $new);
    $this->config->save();
  }

  public function get(string $type): string {
    return str_replace(":prefix:", $this->plugin->getConfig()->get("prefix"), $this->config->get($type));
  }

  public function getArray(string $type): array {
    return $this->config->get($type);
  }

  public function getInt(string $type): int {
    return $this->config->get($type);
  }
}