<?php

function getAkses($group_id, $modul_id)
{
    $cek = App\Permission::where('modul_id', $modul_id)
                ->where('group_id', $group_id)->first();

    if ( $cek == "" ) {
        if ( $modul_id == 1) {
            return "<script language='javascript'>
            		alert('Anda Tidak Memiliki Akses');
            		document.location='".asset('/')."';
            		</script>";
        } else if ( $modul_id == 2 ) {
            return 'FALSE';
        }
    }
}