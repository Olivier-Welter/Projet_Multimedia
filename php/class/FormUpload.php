<?php
class FormUpload extends BaseForm {
    const ERRORS = ['OK', 'INI_SIZE', 'FORM_SIZE', 'PARTIAL','NO_FILE', 'NO_TMP_DIR', 'CANT_WRITE', 'EXTENSION'];
    private $msg = '';

    public function __construct(){
        $this->formAttr = ['action'=>'#', 'method'=>'post', 'name'=>'upload', 'enctype'=>"multipart/form-data"];
        $this->addElem('input', ['type' => 'file', 'name' => 'fic', 'accept' => "audio/*,video/*,image/*"], 'Fichier : ');
        $this->addElem('input', ['type' => 'hidden', 'name'=>"MAX_FILE_SIZE", 'value'=>"100000000"]);
        $this->addElem('textarea', ['name' => "descr"], 'Description : ');
        $this->addElem('input', ['name' => "send", 'type' => 'submit', 'value'=>'Envoyer']);

        if(isset($_POST['send'])){
            if ($this->check()){
                $mime = $_FILES['fic']['type'];
                $chemin = '';
                $descr = $_POST['descr'];
                $file = pathinfo(htmlspecialchars ($_FILES['fic']['name']));
                $mime_t = substr($mime, 0, 5);
                switch ($mime_t){
                    case ('video'):
                        $chemin = 'multimedia/video';
                        break;
                    case ('image'):
                        $chemin = "multimedia/image";
                        break;
                    case ('audio'):
                        $chemin = 'multimedia/audio';
                        break;
                    default:
                        $this->msg = 'Format de fichier non supporté : '.$_FILES['fic']['type'];
                        return;
                }
                /*switch ($file['extension']){
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
                }*/
                $new_name = htmlspecialchars ($file['basename']);
                $new_name = preg_replace('~\p{Mn}~u', '', $new_name);
                $new_name = preg_replace('/([^.a-z0-9]+)/i', '-', $new_name);
                $new_location = $chemin.'/'.$new_name;
                //echo $new_location."<br>\n";
                if (move_uploaded_file(htmlspecialchars ($_FILES['fic']['tmp_name']),$new_location)){
                    //echo 'transfert effectué';
                    //try{
                        //récupérer id de l'auteur
                        $s = Session::getInstance();
                        $auteur = $s->get('login');
                        //enregistrer fichier dans la base de données
                        $query = "INSERT INTO datas (chemin_relatif, mime_type, description, auteur_id, date) VALUES ('$new_name', '$mime', '$descr','$auteur', '".date("Y-m-d H:i:s")."')";
                        //echo $query;
                        if($res = ConnectDB::dbCRUD($query)){
                            $this->msg = "<p>Le fichier $new_name a bien été envoyé</p>\n";
                        }
                    /*}catch (Exception $e){
                        echo "Erreur lors de l'envoi en base de données : $e->getMessage()\n";
                    }*/
                } else {
                    $this->msg = 'Erreur transfert : '.self::ERRORS[$_FILES['fic']['error']];
                }
            }
        }
    }

    public function check(){
        //vérifier fichier
        if($_FILES['fic']['error']!=0){
            $this->msg = 'Erreur transfert : '.self::ERRORS[$_FILES['fic']['error']];
            return false;
        }
        $mime = substr($_FILES['fic']['type'], 0, 5);
        if(($mime != 'image')&&($mime != 'audio')&&($mime != 'video')){
            $this->msg = 'Format de fichier non supporté : '.$_FILES['fic']['type'];
            return false;
        }
        //vérifier longueur description
        if(strlen($_POST['descr'])>200){
            $this->msg = 'La description ne doit pas dépasser 200 caractères';
            $this->champsAttr[2]['class'] = 'invalid';
            return false;
        }
        return true;
    }

    public function getMsg(){
        return $this->msg;
    }
}
