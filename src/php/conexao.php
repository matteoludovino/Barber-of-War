<?php
// Configurações do Banco de Dados
$host = "localhost";      // Onde o banco está (geralmente localhost em XAMPP/WAMP)
$usuario = "root";        // Usuário padrão do MySQL
$senha = "";              // Senha padrão (geralmente vazia no XAMPP, ou 'root' no MAMP)
$banco = "barber_of_war"; // O nome do banco que criamos no passo anterior

//conexão
try {
    //conexão usando PDO
    $pdo = new PDO("mysql:host=$host;dbname=$banco;charset=utf8", $usuario, $senha);
    
    // Configura o PDO para lançar exceções em caso de erro (ajuda muito a achar bugs)
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    // Se der erro, mostra o motivo
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}
?>