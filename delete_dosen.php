<?php 
    require 'function.php';
    $id = $_GET['id_dosen'];
    
    if (delete('dosen', 'id_dosen', $id) > 0) {
        echo "
            <script>
                alert('data berhasil dihapus!');
                document.location.href = 'dosen.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('data gagal dihapus!');
                document.location.href = 'dosen.php';
            </script>
        ";
    }

?>