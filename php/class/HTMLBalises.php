<?php

class HTMLBalises
{
    private $htmlBaliseMsg;
    private $htmlBaliseType;
    private $htmlBaliseAttrib=[];

    public function __construct($htmlType, $htmlAttrib = [], $htmlMsg='')
    {
        $this->htmlBaliseType = $htmlType;
        $this->htmlBaliseAttrib = $htmlAttrib;
        $this->htmlBaliseMsg = $htmlMsg;
    }

    public function __toString()
    {
        $toString = '<'.$this->htmlBaliseType;
        foreach($this->htmlBaliseAttrib as $key => $val)
        {
            $toString = $toString.' '.$key.'="'.$val.'"';
        }
        //$toString = $toString.'>'."\n";

        //if($this->htmlBaliseType === 'input')
        switch($this->htmlBaliseType)
        {
            case ('input'):
            case ('br'):
            case ('img'):
                $toString = $toString.'/>'."\n";
                break;
            default:
                $toString = $toString.'>'."\n";
                $toString = $toString.' '.$this->htmlBaliseMsg;
                $toString = $toString.'</'.$this->htmlBaliseType.'>'."\n";
        }
        return $toString;
    }

    public function getHTMLAttribute($attribName)
    {
        return $this->htmlBaliseAttrib[$attribName];
    }

    public function setHTMLAttribute($attribName, $newVal)
    {
        $this->htmlBaliseAttrib[$attribName] = $newVal;
    }

}
