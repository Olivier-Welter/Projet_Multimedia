<?php
abstract class BaseForm {
    protected $formAttr = [];
    protected $champsType = [];
    protected $champsAttr = [];
    protected $champsLabel = [];

    abstract public function __construct();

    abstract public function verif();

    public function addElem($type, $attr = [], $label = ''){
        $this->champsType[] = $type;
        $this->champsAttr[] = $attr;
        $this->champsLabel[] = $label;
    }

    public function __toString(){
        $str = '';
        foreach($this->champsAttr as $key => $val){
            $in = new HTMLBalises($this->champsType[$key], $val, 'test');
            if($this->champsLabel[$key] !== ''){
                $elem = new HTMLBalises('label', [], $this->champsLabel[$key].$in);
                $str.=' '.$elem;
            }else{
                $str.=' '.$in;
            }
            $str.=' '.new HTMLBalises('br');
        }
        $form = new HTMLBalises('form', $this->formAttr, $str);
        return "$form";
    }
}