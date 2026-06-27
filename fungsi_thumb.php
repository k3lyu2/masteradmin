<?php
/**
 * Menyimpan foto pengguna dengan pemeriksaan ekstensi dan ukuran.
 *
 * @return string Nama file yang sudah aman disimpan.
 */
function upload_foto_user(array $file): string
{
    if (($file['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_NO_FILE) {
        return '';
    }

    if (($file['error'] ?? UPLOAD_ERR_OK) !== UPLOAD_ERR_OK) {
        throw new RuntimeException('Upload foto gagal.');
    }

    if (($file['size'] ?? 0) > 2 * 1024 * 1024) {
        throw new RuntimeException('Ukuran foto maksimal 2 MB.');
    }

    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mime = $finfo->file($file['tmp_name']);
    $ekstensi = [
        'image/jpeg' => 'jpg',
        'image/png' => 'png',
        'image/gif' => 'gif',
    ];

    if (!isset($ekstensi[$mime])) {
        throw new RuntimeException('Foto harus berformat JPG, PNG, atau GIF.');
    }

    $namaFile = 'user-' . bin2hex(random_bytes(8)) . '.' . $ekstensi[$mime];
    $folderTujuan = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'foto_banner';

    if (!is_dir($folderTujuan) && !mkdir($folderTujuan, 0775, true)) {
        throw new RuntimeException('Folder foto tidak dapat dibuat.');
    }

    $tujuan = $folderTujuan . DIRECTORY_SEPARATOR . $namaFile;
    if (!move_uploaded_file($file['tmp_name'], $tujuan)) {
        throw new RuntimeException('Foto tidak dapat disimpan.');
    }

    return $namaFile;
}

