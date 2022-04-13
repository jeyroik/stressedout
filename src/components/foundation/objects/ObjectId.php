<?php
namespace strout\components\founadtion\objects;

use Ramsey\Uuid\Uuid;
use strout\interfaces\foundation\objects\IObjectId;

class ObjectId implements IObjectId
{
    protected $config = [];

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function __invoke(): string
    {
        $raw = $this->getRawId();

        return $raw ?: $this->generateId()->getRawId();
    }

    public function __toString()
    {
        return $this();
    }

    protected function getRawId(): string
    {
        return $this->config[static::FIELD__ID_RAW];
    }

    protected function generateId(): ObjectId
    {
        $this->config[static::FIELD__ID_RAW] = Uuid::uuid6();

        return $this;
    }
}
