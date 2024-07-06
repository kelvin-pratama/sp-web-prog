<?php
try {
    $koneksi = new mysqli("localhost", "root", "", "perpustakaan");
    if ($koneksi->connect_error) {
        throw new Exception("Connection failed: " . $koneksi->connect_error);
    }
} catch (mysqli_sql_exception $e) {
    echo "Gagal konek ke MySQL!\n";
    echo "State: " . $e->getSqlState() . "\n";
    echo "Code: " . $e->getCode() . "\n";
    echo "Message: " . $e->getMessage() . "\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}