<?php

namespace App\Entity;

class ConversationUser
{
    private int $id;
    private int $conversation_id;
    private int $user_id;
    private ?int $last_read_message_id;

    public function __construct(
        int $conversation_id,
        int $user_id,
        ?int $last_read_message_id = null
    ) {
        $this->conversation_id = $conversation_id;
        $this->user_id = $user_id;
        $this->last_read_message_id = $last_read_message_id;
    }

    // Getters
    public function getId(): int
    {
        return $this->id;
    }

    public function getConversationId(): int
    {
        return $this->conversation_id;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function getLastReadMessageId(): ?int
    {
        return $this->last_read_message_id;
    }

    // Setters
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function setConversationId(int $conversation_id): self
    {
        $this->conversation_id = $conversation_id;
        return $this;
    }

    public function setUserId(int $user_id): self
    {
        $this->user_id = $user_id;
        return $this;
    }

    public function setLastReadMessageId(?int $last_read_message_id): self
    {
        $this->last_read_message_id = $last_read_message_id;
        return $this;
    }
}