<?php
class FormUpload extends BaseForm {

    public function __construct(){
        $this->formAttr = ['action'=>'#', 'method'=>'post', 'name'=>'upload', 'enctype'=>"multipart/form-data"];
        $this->addElem('input', ['type' => 'file', 'name' => 'fic'], 'Fichier : ');
        $this->addElem('input', ['type' => 'hidden', 'name'=>"MAX_FILE_SIZE", 'value'=>"100000000"]);
        $this->addElem('textarea', ['name' => "descr"], 'Description : ');
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
                        $s = Session::getInstance();
                        $auteur = $s->get('login');
                        //enregistrer fichier dans la base de données
                        $query = "INSERT INTO datas (chemin_relatif, mime_type, description, auteur_id, date) VALUES ('$new_name', '$mime', '$descr','$auteur', '".date("Y-m-d H:i:s")."')";
                        echo $query;
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

    public function verif(){
        //vérifier longueur description

        //vérifier caractères nom du fichier

        return true;
    }
}
