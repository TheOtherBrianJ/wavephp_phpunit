<?php

namespace WavePHP\Cheer;

use InvalidArgumentException;

class Cheerleader
{
    private $word = '';
    private $pompom;

    public function __construct(Pompom $pompom = null)
    {
        if (empty($pompom)) {
            $pompom = new Pompom();
        }
        $this->setPompom($pompom);
    }

    public function gimmeAn($letter)
    {
        if (!is_string($letter) || 1 != mb_strlen($letter)) {
            throw new InvalidArgumentException(__METHOD__ 
                . ' may only accept a single char arg', 619);
        }
        $this->word .= $letter;
        return $letter;
    }

    public function whatsThatSpell()
    {
        if (!$this->pompom->shake()) {
            throw new PomShakeFailException();
        }
        return $this->word . '!';
    }

    public function doTheSplits()
    {
        throw new LackOfFlexibilityException("I can't do that!");
    }

    public function setPompom(Pompom $pompom)
    {
        $this->pompom = $pompom;
    }
}
