<?php

namespace Templates\Observer;


class Login implements Observable
{
    private $observers = [];
    private $storage;

    const LOGIN_USER_UNKNOWN = 1;
    const LOGIN_WRONG_PASS = 2;
    const LOGIN_ACCESS = 3;
    private $status = [];

    public function __construct()
    {
        $this->observers = [];
    }

    public function attach(Observer $observer)
    {
        $this->observers = $observer;
    }

    public function detach(Observer $observer)
    {
        $this->observers = array_filter($this->observers, function ($a) use ($observer) {
            return ($a !== $observer);
        });
    }

    public function notify()
    {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }

    public function handleLogin($user, $pass, $ip)
    {
        $isValid = false;

        switch (mt_rand(1,3)) {
            case 1:
                $this->setStatus(self::LOGIN_ACCESS, $user, $ip);
                $isValid = true;
                break;
            case 2:
                $this->setStatus(self::LOGIN_WRONG_PASS, $user, $ip);
                $isValid = false;
                break;
            case 3:
                $this->setStatus(self::LOGIN_USER_UNKNOWN, $user, $ip);
                $isValid = false;
                break;
        }
        $this->notify();
        return $isValid;
    }

    private function setStatus($status, $user, $ip)
    {
        $this->status = [$status, $user, $ip];
    }

    public function getStatus()
    {
        return $this->status;
    }

}