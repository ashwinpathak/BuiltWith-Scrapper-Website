<?php

Class Top10
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getTopList($top_list_number = 10)
    {
        $query = $this->db->query("SELECT DISTINCT id, site_url, views FROM topsearch ORDER BY views DESC LIMIT 0,{$top_list_number}");
        $r = $query->FetchAll(PDO::FETCH_ASSOC);

        return $r;
    }

    public function addInList($url)
    {
        $url_check = str_ireplace('http://', '', $url);
        $url_check = str_ireplace('https://', '', $url);
        $url_check = str_ireplace('www.', '', $url);

        $query = $this->db->prepare("SELECT id, views FROM topsearch WHERE site_url = ?");
        $query->bindValue(1, $url);
        $query->execute();

        $r = $query->Fetch(PDO::FETCH_OBJ);

        if($r == null) {
            $timestamp = time();
            $user_ip = $_SERVER['REMOTE_ADDR'];
            $insert = $this->db->prepare("INSERT INTO topsearch (site_url, timestamp, user_ip, views) VALUES(:url, '{$timestamp}', '{$user_ip}', 1)");
            $insert->bindValue(':url', $url);
            $insert->execute();

            if($insert->rowCount() > 0)
                return true;

        } else {
            $views = ($r->views + 1);
            $update = $this->db->query("UPDATE topsearch SET views = {$views} WHERE id = {$r->id}");
            return true;
        }

        return false;
    }
}