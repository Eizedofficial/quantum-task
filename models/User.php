<?php

class User extends Model
{
    /**
     * @var Order[]
     */
    public array $orders = [];

    public Service $service;
}