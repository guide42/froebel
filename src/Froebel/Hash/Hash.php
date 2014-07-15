<?php

namespace Froebel\Hash;

interface Hash
{
    public function supports($data);

    public function tokenize($data);

    public function getName();
}