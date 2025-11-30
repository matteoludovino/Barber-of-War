<?php
// Inclui a conexão que você já fez
include 'conexao.php';

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebe os dados do formulário HTML
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $servico = $_POST['servico'];
    $data_hora = $_POST['data_hora'];
    $observacoes = $_POST['observacoes'];

    // 1. SALVAR NO BANCO DE DADOS
    try {
        // Prepara o comando SQL (Seguro contra invasões)
        $sql = "INSERT INTO tb_agendamentos (nome_cliente, telefone_cliente, id_servico, data_agendamento, observacoes) 
                VALUES (:nome, :telefone, :servico, :data_hora, :observacoes)";
        
        $stmt = $pdo->prepare($sql);
        
        // Substitui os valores
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':servico', $servico); // Aqui assumimos que o value do select é o ID do serviço
        $stmt->bindParam(':data_hora', $data_hora);
        $stmt->bindParam(':observacoes', $observacoes);

        $stmt->execute();

        // 2. REDIRECIONAR PARA O WHATSAPP
        // Formata a data para ficar bonita na mensagem (ex: 12/09/2025 às 15:00)
        $data_formatada = date('d/m/Y H:i', strtotime($data_hora));
        
        // Número do barbeiro (Coloque o número real aqui, apenas dígitos)
        $numero_barbeiro = "5521999999999"; 

        $mensagem = "Olá! Me chamo *$nome*.\n";
        $mensagem .= "Gostaria de confirmar meu agendamento para *$data_formatada*.\n";
        $mensagem .= "Serviço: $servico\n"; // Se quiser o nome do serviço, precisaria buscar no banco, mas o ID serve para o teste
        $mensagem .= "Observações: $observacoes";

        // Codifica a mensagem para URL
        $link_whatsapp = "https://wa.me/$numero_barbeiro?text=" . urlencode($mensagem);

        // Redireciona o usuário
        header("Location: $link_whatsapp");
        exit();

    } catch (PDOException $e) {
        echo "Erro ao agendar: " . $e->getMessage();
    }
} else {
    // Se tentar abrir o arquivo direto sem enviar o formulário
    echo "Acesso inválido.";
}
?>