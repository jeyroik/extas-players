<?php

use extas\components\players\PlayerService;
use extas\components\repositories\RepoItem;

return [
    "name" => "extas\players",
    "tables" => [
        "players" => [
            "namespace" => "extas\\repositories",
            "item_class" => "extas\\components\\players\\Player",
            "pk" => "id",
            "aliases" => ["players"],
            "hooks" => [],
            "code" => [
                'create-before' => '\\' . RepoItem::class . '::setId($item);'
                                  .'\\' . RepoItem::class . '::throwIfExist($this, $item, [\'name\']);'
                                  .'$item = (new \\' . PlayerService::class . '())->generateToken($item);'
            ]
        ],
        "players_identities" => [
            "namespace" => "extas\\repositories",
            "item_class" => "extas\\components\\players\\identities\\PlayerIdentity",
            "pk" => "id",
            "aliases" => ["playersIdentities"],
            "hooks" => [],
            "code" => [
                'create-before' => '\\' . RepoItem::class . '::setId($item);'
                                  .'\\' . RepoItem::class . '::throwIfExist($this, $item, [\'name\', \'value\']);'
            ]
        ],
        "players_identities_providers" => [
            "namespace" => "extas\\repositories",
            "item_class" => "extas\\components\\players\\identities\\PlayerIdentityProvider",
            "pk" => "id",
            "aliases" => ["playersIdentitiesProviders"],
            "hooks" => [],
            "code" => [
                'create-before' => '\\' . RepoItem::class . '::setId($item);'
                                  .'\\' . RepoItem::class . '::throwIfExist($this, $item, [\'name\']);'
            ]
        ]
    ]
];
