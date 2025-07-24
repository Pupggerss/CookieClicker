<?php

namespace pup\cookieclicker;

use muqsit\invmenu\InvMenuHandler;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\plugin\PluginBase;

final class Loader extends PluginBase implements Listener
{

    public function onEnable(): void
    {
        if(!InvMenuHandler::isRegistered()){
            InvMenuHandler::register($this);
        }

        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onJoin(PlayerJoinEvent $event): void
    {
        $player = $event->getPlayer();
        CookieMenu::send($player);
    }
}