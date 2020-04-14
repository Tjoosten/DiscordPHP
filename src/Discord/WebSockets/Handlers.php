<?php

/*
 * This file is apart of the DiscordPHP project.
 *
 * Copyright (c) 2016 David Cole <david@team-reflex.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the LICENSE.md file.
 */

namespace Discord\WebSockets;

/**
 * This class contains all the handlers for the individual WebSocket events.
 */
class Handlers
{
    /**
     * An array of handlers.
     *
     * @var array Array of handlers.
     */
    protected $handlers = [];

    /**
     * Constructs the list of handlers.
     *
     * @return void
     */
    public function __construct()
    {
        // General
        $this->addHandler(Event::PRESENCE_UPDATE, \Discord\WebSockets\Events\PresenceUpdate::class);
        $this->addHandler(Event::TYPING_START, \Discord\WebSockets\Events\TypingStart::class);
        $this->addHandler(Event::VOICE_STATE_UPDATE, \Discord\WebSockets\Events\VoiceStateUpdate::class);
        $this->addHandler(Event::VOICE_SERVER_UPDATE, \Discord\WebSockets\Events\VoiceServerUpdate::class);

        // Guild Event handlers
        $this->addHandler(Event::GUILD_CREATE, \Discord\WebSockets\Events\Guild\Create::class);
        $this->addHandler(Event::GUILD_DELETE, \Discord\WebSockets\Events\Guild\Delete::class);
        $this->addHandler(Event::GUILD_UPDATE, \Discord\WebSockets\Events\Guild\Update::class);

        // Channel Event handlers
        $this->addHandler(Event::CHANNEL_CREATE, \Discord\WebSockets\Events\Channel\ChannelCreate::class);
        $this->addHandler(Event::CHANNEL_UPDATE, \Discord\WebSockets\Events\Channel\Update::class);
        $this->addHandler(Event::CHANNEL_DELETE, \Discord\WebSockets\Events\Channel\Delete::class);
        $this->addHandler(Event::CHANNEL_PINS_UPDATE, \Discord\WebSockets\Events\Channel\PinsUpdate::class);

        // Ban Event handlers
        $this->addHandler(Event::GUILD_BAN_ADD, \Discord\WebSockets\Events\Guild\BanAdd::class);
        $this->addHandler(Event::GUILD_BAN_REMOVE, \Discord\WebSockets\Events\Guild\BanRemove::class);

        // Message handlers
        $this->addHandler(Event::MESSAGE_CREATE, \Discord\WebSockets\Events\MessageCreate::class, ['message']);
        $this->addHandler(Event::MESSAGE_DELETE, \Discord\WebSockets\Events\MessageDelete::class);
        $this->addHandler(Event::MESSAGE_DELETE_BULK, \Discord\WebSockets\Events\MessageDeleteBulk::class);
        $this->addHandler(Event::MESSAGE_UPDATE, \Discord\WebSockets\Events\MessageUpdate::class);
        $this->addHandler(Event::MESSAGE_REACTION_ADD, \Discord\WebSockets\Events\MessageReactionAdd::class);
        $this->addHandler(Event::MESSAGE_REACTION_REMOVE, \Discord\WebSockets\Events\MessageReactionRemove::class);
        $this->addHandler(Event::MESSAGE_REACTION_REMOVE_ALL, \Discord\WebSockets\Events\MessageReactionRemoveAll::class);

        // New Member Event handlers
        $this->addHandler(Event::GUILD_MEMBER_ADD, \Discord\WebSockets\Events\Guild\MemberAdd::class);
        $this->addHandler(Event::GUILD_MEMBER_REMOVE, \Discord\WebSockets\Events\Guild\MemberRemove::class);
        $this->addHandler(Event::GUILD_MEMBER_UPDATE, \Discord\WebSockets\Events\Guild\MemberUpdate::class);

        // New Role Event handlers
        $this->addHandler(Event::GUILD_ROLE_CREATE, \Discord\WebSockets\Events\Guild\RoleCreate::class);
        $this->addHandler(Event::GUILD_ROLE_DELETE, \Discord\WebSockets\Events\Guild\RoleDelete::class);
        $this->addHandler(Event::GUILD_ROLE_UPDATE, \Discord\WebSockets\Events\Guild\RoleUpdate::class);
    }

    /**
     * Adds a handler to the list.
     *
     * @param string $event        The WebSocket event name.
     * @param string $classname    The Event class name.
     * @param array  $alternatives Alternative event names for the handler.
     *
     * @return void
     */
    public function addHandler($event, $classname, array $alternatives = [])
    {
        $this->handlers[$event] = [
            'class'        => $classname,
            'alternatives' => $alternatives,
        ];
    }

    /**
     * Returns a handler.
     *
     * @param string $event The WebSocket event name.
     *
     * @return string|null The Event class name or null;
     */
    public function getHandler($event)
    {
        if (isset($this->handlers[$event])) {
            return $this->handlers[$event];
        }
    }

    /**
     * Returns the handlers array.
     *
     * @return array Array of handlers.
     */
    public function getHandlers()
    {
        return $this->handlers;
    }

    /**
     * Returns the handlers.
     *
     * @return array Array of handler events.
     */
    public function getHandlerKeys()
    {
        return array_keys($this->handlers);
    }

    /**
     * Removes a handler.
     *
     * @param  string $event The event handler to remove.
     * @return void
     */
    public function removeHandler($event): void
    {
        unset($this->handlers[$event]);
    }
}
