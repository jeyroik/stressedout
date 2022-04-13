<?php
namespace strout\interfaces\foundation\objects;

interface IObjectId
{
    public const FIELD__ID_RAW = 'id_raw';

    public function __invoke(): string;
}
