<?php

class HTMLBalises
{
    private $htmlBaliseMsg;
    private $htmlBaliseType;
    private $htmlBaliseAttrib=[];

    public function __construct($htmlType, $htmlAttrib, $htmlMsg='')
    {
        $this->htmlBaliseType = $htmlType;
        $this->htmlBaliseAttrib = $htmlAttrib;
        $this->htmlBaliseMsg = $htmlMsg;
    }

    public function __toString()
    {
        $toString = '<'.$this->htmlBaliseType.' ';
        foreach($this->htmlBaliseAttrib as $key => $val)
        {
            $toString = $toString.$key.'="'.$val.'" ';
        }
        $toString = $toString.'>'."\n";

        if($this->htmlBaliseType === 'input')
        switch($this->htmlBaliseType)
        {
            case ('input'):
                break;
            case ('br'):
                $toString = $toString.'/>';
                break;
            default:
                $toString = $toString.'</'.$this->htmlBaliseType.'>';
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