<?php


namespace App\Model;


use DateTime;
use Exception;

class Post
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $fromName;

    /**
     * @var string
     */
    private $fromId;

    /**
     * @var string
     */
    private $message;

    /**
     * @var string
     */
    private $type;

    /**
     * @var DateTime
     */
    private $created_time;

    /**
     * Post constructor.
     *
     * @param string $id
     * @param string $fromName
     * @param string $fromId
     * @param string $message
     * @param string $type
     * @param string $created_time
     *
     * @throws Exception
     */
    public function __construct(
        string $id,
        string $fromName,
        string $fromId,
        string $message,
        string $type,
        string $created_time
    )
    {
        $this->id = $id;
        $this->fromName = $fromName;
        $this->fromId = $fromId;
        $this->message = $message;
        $this->type = $type;
        $this->created_time = new DateTime($created_time);
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getFromName(): string
    {
        return $this->fromName;
    }

    /**
     * @return string
     */
    public function getFromId(): string
    {
        return $this->fromId;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return DateTime
     */
    public function getCreatedTime(): DateTime
    {
        return $this->created_time;
    }
}
