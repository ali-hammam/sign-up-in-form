<?php
namespace Commands;

interface Command
{
    public function execute($type = null , $fileName = null);
}