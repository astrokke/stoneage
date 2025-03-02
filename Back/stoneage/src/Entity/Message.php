<?php

class Message
{
    private int $id;
    private int $conversation_id;
    private int $sender_id;
    private string $content;
    private ?string $created_at;
    private ?string $file_url;

    public function __construct(
        int $conversation_id, 
        int $sender_id, 
        string $content, 
        ?string $created_at = null, 
        ?string $file_url = null
    ) {
        $this->conversation_id = $conversation_id;
        $this->sender_id = $sender_id;
        $this->content = $content;
        $this->created_at = $created_at;
        $this->file_url = $file_url;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getConversationId(): int
    {
        return $this->conversation_id;
    }

    public function setConversationId(int $conversation_id): self
    {
        $this->conversation_id = $conversation_id;
        return $this;
    }

    public function getSenderId(): int
    {
        return $this->sender_id;
    }

    public function setSenderId(int $sender_id): self
    {
        $this->sender_id = $sender_id;
        return $this;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }

    public function getCreatedAt(): ?string
    {
        return $this->created_at;
    }

    public function setCreatedAt(?string $created_at): self
    {
        $this->created_at = $created_at;
        return $this;
    }

    public function getFileUrl(): ?string
    {
        return $this->file_url;
    }

    public function setFileUrl(?string $file_url): self
    {
        $this->file_url = $file_url;
        return $this;
    }
}