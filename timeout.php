<?php
// Session berakhir jika tidak ada aktivitas selama 30 menit.
const SESSION_TIMEOUT = 1800;

function timer(): void
{
    $_SESSION['timeout'] = time();
}

function cek_login(): bool
{
    if (!isset($_SESSION['timeout'])) {
        return false;
    }

    if ((time() - (int) $_SESSION['timeout']) > SESSION_TIMEOUT) {
        return false;
    }

    timer();
    return true;
}

