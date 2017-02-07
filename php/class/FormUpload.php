<?php
class FormUpload extends BaseForm {

    public function __construct(){
        $this->formAttr = ['action'=>'#', 'method'=>'post', 'name'=>'upload', 'enctype'=>"multipart/form-data"];
        $this->addElem('input', ['type' => 'file', 'name' => 'fic'], 'Fichier : ');
        $this->addElem('input', ['type' => 'hidden', 'name'=>"MAX_FILE_SIZE", 'value'=>"100000000"]);
        $this->addElem('input', ['name' => "descr", 'type' => 'text'], 'Description : ');
        $this->addElem('input', ['name' => "send", 'type' => 'submit', 'value'=>'Envoyer']);

        if(isset($_POST['send'])){
            if ($this->verif()){
                $mime = $_FILES['fic']['type'];
                $chemin = '';
                $descr = $_POST['descr'];
                $file = pathinfo(htmlspecialchars ($_FILES['fic']['name']));
                switch ($file['extension']){
                    case ('webm'):
                        $chemin = 'multimedia/video';
                        break;
                    case ('png'):
                    case ('gif'):
                    case ('svg'):
                    case ('jpeg'):
                    case ('jpg'):   //variantes du jpeg
                    case ('jpe'):
                    case ('jfif'):
                    case ('jfi'):
                        $chemin = "multimedia/img";
                        break;
                    case ('ogg'):
                    case ('mp3'):
                        $chemin = 'multimedia/audio';
                }
                $new_name = htmlspecialchars ($file['basename']);
                $new_location = $chemin.'/'.$new_name;
                //echo $new_location."<br>\n";
                if (move_uploaded_file(htmlspecialchars ($_FILES['fic']['tmp_name']),$new_location)){
                    //echo 'transfert effectué';
                    try{
                        $dbc = new ConnectDB(
                            'mysql',
                            'maemoon_com',
                            'localhost',
                            'root',
                            '');
                        /*$dbc = new ConnectDB(
                            'mysql',
                            'mediabdd',
                            'localhost',
                            'root',
                            '');*/
                        //récupérer id de l'auteur

                        //enregistrer fichier dans la base de données
                        $query = "INSERT INTO datas (chemin_relatif, mime_type, description, auteur_id, date) VALUES ('$new_name', '$mime', '$descr', 1, '".date("Y-m-d H:i:s")."')";
                        //echo $query;
                        if($res = $dbc->dbCRUD($query)){
                            echo "<p>Le fichier $new_name a bien été envoyé</p>\n";
                        }
                    }catch (Exception $e){
                        echo "Erreur lors de l'envoi en base de données : $e->getMessage()\n";
                    }
                } else {
                    echo 'ereur transfert : '.$_FILES['fic']['error'];
                }
            }
        }
    }

    /*public function __toString(){ $str = ''; foreach($this->champsAttr as $key => $val){ $in = new HTMLBalises($this->champsType[$key], $val, 'test'); if($this->champsLabel[$key] !== ''){ $elem = new HTMLBalises('label', [], $this->champsLabel[$key].$in); $str.=' '.$elem; }else{ $str.=' '.$in; } $str.=' '.new HTMLBalises('br'); } $form = new HTMLBalises('form', ['action'=>'#', 'method'=>'post', 'name'=>'searchform'], $str); return "$form"; }*/

    public function verif(){
        return true;
        //return Validator::check_desc_search($champsAtrr[1]['value']);
    }
}
