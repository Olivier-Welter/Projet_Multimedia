<?php

class HTMLBalises
{
    private $htmlBaliseMsg;
    private $htmlBaliseType;
    private $htmlBaliseAttrib=[];

    /* constructeur
    paramètres :
    $htmlType : string, type de balise
    $htmlAttrib : tableau associatif des attributs de la balise [attribut => valeur] (facultatif)
    $htmlMsg : string, contenu de la balise, affiché seulement si la balise n'est pas auto-fermante (facultatif)
    */
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

        switch($this->htmlBaliseType)
        {
            case ('area'):
            case ('base'):
            case ('br'):
            case ('col'):
            case ('embed'):
            case ('hr'):
            case ('img'):
            case ('input'):
            case ('keygen'):
            case ('link'):
            case ('meta'):
            case ('param'):
            case ('source'):
            case ('track'):
            case ('wbr'):
                $toString = $toString.'/>'."\n";
                break;
            default:
                $toString = $toString.'>'."\n";
                $toString = $toString.$this->htmlBaliseMsg;
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
