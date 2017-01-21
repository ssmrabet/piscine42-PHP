<?php
    function auth($login, $passwd) {
        if (!$login || !$passwd)
            return false;
        $compte = unserialize(file_get_contents('../private/passwd'));
        if ($compte) {
            foreach ($compte as $i => $p) {
                if ($p['login'] == $login && $p['passwd'] == hash('whirlpool', $passwd))
                    return true;
            }
        }
        return false;
    }
?>
