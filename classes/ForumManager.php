<?php

/**
 * Manager qui gère les informations relatives au forum
 */
class ForumManager
{
    private $_bdd = null;

    public function __construct()
    {
        $this->_bdd = new PDO("mysql:host=localhost;dbname=ouahjax", "ouahjax", "");
        $this->_bdd->exec("SET NAMES utf8;");
    }

    public function getNombreForum()
    {
        $request = $this->_bdd->prepare("SELECT count(id) as nb FROM forums  WHERE id != 0;");
        $request->execute();
        $data = $request->fetch(PDO::FETCH_ASSOC);
        return $data['nb'];
    }

    public function getNombreSujet()
    {
        $request = $this->_bdd->prepare("SELECT count(id) as nb FROM sujets  WHERE id != 0;");
        $request->execute();
        $data = $request->fetch(PDO::FETCH_ASSOC);
        return $data['nb'];
    }

    public function getRandomSujet($nb)
    {
        $request = $this->_bdd->prepare("SELECT * FROM `sujets` WHERE id != 0 ORDER BY RAND() LIMIT $nb");
        $request->execute();
        $data = $request->fetchAll(PDO::FETCH_ASSOC);
        $ret = [];
        for ($i = 0; $i < count($data); $i++) {
            $ret[$i] = new ElementSujet($data[$i]);
        }
        if (count($data)) {
            return $ret;
        } else {
            return null;
        }
    }


    public function getSujetByForum($idforum)
    {

        $request = $this->_bdd->prepare("SELECT * FROM `sujets` WHERE forum_id = $idforum ORDER BY date_post DESC");
        $request->execute();
        $data = $request->fetchAll(PDO::FETCH_ASSOC);
        $ret = [];
        for ($i = 0; $i < count($data); $i++) {
            $ret[$i] = new ElementSujet($data[$i]);
        }
        if (count($data)) {
            return $ret;
        } else {
            return null;
        }
    }


    public function getMessageBySujet($idsujet)
    {

        $request = $this->_bdd->prepare("SELECT * FROM `messages` WHERE id_sujet = $idsujet ORDER BY date ASC");
        $request->execute();
        $data = $request->fetchAll(PDO::FETCH_ASSOC);
        $ret = [];
        for ($i = 0; $i < count($data); $i++) {
            $ret[$i] = new ElementMessage($data[$i]);
        }
        if (count($data)) {
            return $ret;
        } else {
            return null;
        }
    }

    public function getMessageById($idmessage)
    {

        $request = $this->_bdd->prepare("SELECT * FROM `messages` WHERE id = $idmessage");
        $request->execute();
        $data = $request->fetch(PDO::FETCH_ASSOC);
        if ($data) {
            return new ElementMessage($data);
        } else {
            return null;
        }
    }

    public function getSujetById($idsujet)
    {

        $request = $this->_bdd->prepare("SELECT * FROM `sujets` WHERE id = $idsujet AND id != 0");
        $request->execute();
        $data = $request->fetch(PDO::FETCH_ASSOC);
        if ($data) {
            return new ElementSujet($data);
        } else {
            return null;
        }
    }


    public function getNombreReponsesSujet($id)
    {
        $request = $this->_bdd->prepare("SELECT count(id) AS nb FROM `messages` WHERE id_sujet = ?");
        $request->execute([$id]);
        $data = $request->fetch(PDO::FETCH_ASSOC);
        if ($data) {
            return $data['nb'];
        } else {
            return 0;
        }
    }

    public function getLastPostSujet($sujet_id)
    {
        $request = $this->_bdd->prepare("SELECT id_user, date FROM messages WHERE id_sujet = ? ORDER BY date DESC LIMIT 1");
        $request->execute([$sujet_id]);
        return $request->fetch(PDO::FETCH_ASSOC);
    }

    public function getListeForums()
    {
        $request = $this->_bdd->prepare("SELECT id, titre, description, date FROM forums WHERE id != 0");
        $request->execute();
        return $request->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getNombreSujetForum($forum_id)
    {
        $request = $this->_bdd->prepare("SELECT count(id) as nb FROM sujets WHERE forum_id = ?");
        $request->execute([$forum_id]);
        $data = $request->fetch(PDO::FETCH_ASSOC);
        if ($data) {
            return $data['nb'];
        } else {
            return 0;
        }
    }

    public function getNombrePostForum($forum_id)
    {
        $request = $this->_bdd->prepare("SELECT count(messages.id) as nb FROM sujets INNER JOIN messages ON sujets.id = messages.id_sujet WHERE forum_id = ?");
        $request->execute([$forum_id]);
        $data = $request->fetch(PDO::FETCH_ASSOC);
        if ($data) {
            return $data['nb'];
        } else {
            return 0;
        }
    }

    public function getLastPostForum($forum_id)
    {
        $request = $this->_bdd->prepare("SELECT messages.id_user, messages.date, messages.id_sujet, sujets.titre, sujets.forum_id FROM messages INNER JOIN sujets ON messages.id_sujet = sujets.id INNER JOIN forums ON sujets.forum_id = forums.id WHERE forums.id = ? ORDER BY messages.date DESC LIMIT 1");
        $request->execute([$forum_id]);
        return $request->fetch(PDO::FETCH_ASSOC);
    }

    public function getForumName($forum_id)
    {
        $request = $this->_bdd->prepare("SELECT titre FROM forums WHERE id = ?;");
        $request->execute([$forum_id]);
        $data = $request->fetch(PDO::FETCH_ASSOC);
        if ($data) {
            return $data['titre'];
        } else {
            return '';
        }
    }

    public function getSujetName($sujet_id)
    {
        $request = $this->_bdd->prepare("SELECT titre FROM sujets WHERE id = ? AND id != 0;");
        $request->execute([$sujet_id]);
        $data = $request->fetch(PDO::FETCH_ASSOC);
        if ($data) {
            return htmlspecialchars($data['titre']);
        } else {
            return '';
        }
    }

    public function getForumIdBySujetId($sujet_id)
    {
        $request = $this->_bdd->prepare("SELECT forum_id FROM sujets WHERE id = ? AND id != 0;");
        $request->execute([$sujet_id]);
        $data = $request->fetch(PDO::FETCH_ASSOC);
        if ($data) {
            return $data['forum_id'];
        } else {
            return 0;
        }
    }


    public function forumExiste($forum_id)
    {
        $request = $this->_bdd->prepare("SELECT id FROM forums WHERE id = ? AND id != 0");
        $request->execute([$forum_id]);
        $data = $request->fetch(PDO::FETCH_ASSOC);
        if ($data) {
            return true;
        } else {
            return false;
        }
    }

    public function sujetExiste($sujet_id)
    {
        $request = $this->_bdd->prepare("SELECT id FROM sujets WHERE id = ? AND id != 0");
        $request->execute([$sujet_id]);
        $data = $request->fetch(PDO::FETCH_ASSOC);
        if ($data) {
            return true;
        } else {
            return false;
        }
    }

    public function ajoutSujet($titre, $message, $forum_id, $user_id)
    {
        if ($this->forumExiste($forum_id)) {
            $request = $this->_bdd->prepare("INSERT INTO sujets (titre,message, forum_id,user_id) VALUES (?,?,?,?)");
            $request->execute([$titre, $message, $forum_id, $user_id]);
            return $this->_bdd->lastInsertId();
        } else {
            return 0;
        }
    }

    public function supprimerSujet($id)
    {
        $request = $this->_bdd->prepare("DELETE FROM messages WHERE id_sujet = ?");
        $request->execute([$id]);

        $request = $this->_bdd->prepare("DELETE FROM sujets WHERE id = ?");
        $request->execute([$id]);
    }

    public function verifMessageSujet($parent, $sujet_id)
    {
        $request = $this->_bdd->prepare("SELECT id_sujet FROM messages WHERE id = ?");
        $request->execute([$parent]);
        $data = $request->fetch(PDO::FETCH_ASSOC);
        if ($data) {
            if ($sujet_id == $data['id_sujet']) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function addMessage($message, $sujet_id, $parent, $user_id)
    {
        if ($parent) {
            $request = $this->_bdd->prepare("INSERT INTO messages (id_parent,message, id_sujet,id_user) VALUES (?,?,?,?)");
            $request->execute([$parent, $message, $sujet_id, $user_id]);
        } else {
            $request = $this->_bdd->prepare("INSERT INTO messages (message, id_sujet,id_user) VALUES (?,?,?)");
            $request->execute([$message, $sujet_id, $user_id]);
        }
    }

    public function supprimerMessage($id)
    {
        $request = $this->_bdd->prepare("UPDATE messages SET id_parent = 0 WHERE id_parent = ?");
        $request->execute([$id]);

        $request = $this->_bdd->prepare("DELETE FROM messages WHERE id = ?");
        $request->execute([$id]);

    }
}
