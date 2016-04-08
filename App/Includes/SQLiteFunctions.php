<?php

function getSetting($setting_name)
{
    $db = $GLOBALS['pdo'];

    $query = $db->prepare("SELECT value FROM settings WHERE name = ?");
    $query->bindValue(1, $setting_name);
    $query->execute();

    $r = $query->Fetch(PDO::FETCH_OBJ);

    if($r != null)
        return html_entity_decode($r->value, ENT_QUOTES, 'utf-8');

    return false;
}

function setSetting($setting_name, $setting_value)
{
    $db = $GLOBALS['pdo'];

    $query = $db->prepare("UPDATE settings SET value = ? WHERE name = ?");
    $query->bindValue(1, $setting_value);
    $query->bindValue(2, $setting_name);
    $query->execute();

    if($query->rowCount() > 0)
        return true;

    return false;

}