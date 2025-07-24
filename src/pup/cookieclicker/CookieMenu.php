<?php

namespace pup\cookieclicker;

use muqsit\invmenu\InvMenu;
use muqsit\invmenu\transaction\InvMenuTransaction;
use muqsit\invmenu\type\InvMenuTypeIds;
use pocketmine\item\VanillaItems;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;

final class CookieMenu
{
    public static function send(Player $player)
    : void
    {
        $clicks = 0;
        $menu = InvMenu::create(InvMenuTypeIds::TYPE_HOPPER);
        $menu->setName(TF::GREEN . "Cookie Clicker");

        $inv = $menu->getInventory();
        $cookie = VanillaItems::COOKIE()
            ->setCustomName(TF::GREEN . "Cookie")
            ->setLore([TF::YELLOW . "Clicks: " . $clicks]);

        $inv->setItem(2, $cookie);


        $menu->setListener(function (InvMenuTransaction $transaction) use (&$clicks, $player, $inv) {
            $clicked = $transaction->getItemClicked();
            if ($clicked->getTypeId() === VanillaItems::COOKIE()->getTypeId()) {
                $clicks++;
                $cookie = VanillaItems::COOKIE()
                    ->setCustomName(TF::GREEN . "Cookie")
                    ->setLore([TF::YELLOW . "Clicks: " . $clicks]);
                $inv->setItem(2, $cookie);
            }
            return $transaction->discard();
        });

        $menu->setInventoryCloseListener(function (Player $player){
            self::send($player);
        });

        $menu->send($player);
    }

}