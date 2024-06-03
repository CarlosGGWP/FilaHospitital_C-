<?php

class HospitalQueue {
    private $queue = array();
    
    public function cadastrarPaciente($nome) {
        if (count($this->queue) >= 10) {
            echo "A fila de pacientes está cheia. Não é possível cadastrar mais pacientes.\n";
            return;



        }
        $this->queue[] = $nome;
        echo "Paciente cadastrado com sucesso!\n";
    }
    
    public function listarFila() {
        echo "Fila de pacientes:\n";
        foreach ($this->queue as $index => $paciente) {

            echo ($index + 1) . ". $paciente\n";
        }
    }
    
    public function inserirPacientePrioritario($nome) {
        array_unshift($this->queue, $nome);
        echo "Paciente prioritário inserido na frente da fila.\n";

    }
    
    public function atenderPaciente() {
        if (empty($this->queue)) {
            echo "Não há pacientes na fila para serem atendidos.\n";
            return;

        }
        $pacienteAtendido = array_shift($this->queue);
        echo "Paciente $pacienteAtendido foi atendido e removido da fila.\n";
    }
    
    public function proximoPaciente() {
        if (empty($this->queue)) {
            echo "Não há pacientes na fila.\n";
            return;
        }
        $proximoPaciente = $this->queue[0];
        echo "O próximo paciente a ser atendido é: $proximoPaciente\n";
    }
    
    public function verificarPaciente($nome) {
        if (in_array($nome, $this->queue)) {
            echo "O paciente $nome está na fila.\n";
        } else {
            echo "O paciente $nome não está na fila.\n";
        }
    }
    
    public function removerPaciente($nome) {
        $posicao = array_search($nome, $this->queue);
        if ($posicao !== false) {
            array_splice($this->queue, $posicao, 1);
            echo "O paciente $nome foi removido da fila.\n";
        } else {
            echo "O paciente $nome não está na fila.\n";
        }
    }
}

$hospitalQueue = new HospitalQueue();

while (true) {
    echo "\nMenu:\n";
    echo "1. Cadastrar paciente\n";
    echo "2. Listar fila de pacientes\n";
    echo "3. Inserir paciente prioritário\n";
    echo "4. Atender próximo paciente\n";
    echo "5. Exibir próximo paciente a ser atendido\n";
    echo "6. Verificar se um paciente está na fila\n";
    echo "7. Remover paciente da fila\n";
    echo "Pressione 'q' para sair\n";

    $opcao = readline("Escolha uma opção: ");

    switch ($opcao) {
        case '1':
            $nomePaciente = readline("Digite o nome do paciente: ");
            $hospitalQueue->cadastrarPaciente($nomePaciente);
            break;

        case '2':
            $hospitalQueue->listarFila();
            break;
        case '3':
            $nomePacientePrioritario = readline("Digite o nome do paciente prioritário: ");
            $hospitalQueue->inserirPacientePrioritario($nomePacientePrioritario);
            break;
        case '4':
            $hospitalQueue->atenderPaciente();
            break;
        case '5':
            $hospitalQueue->proximoPaciente();
            break;
        case '6':
            $nomePaciente = readline("Digite o nome do paciente: ");
            $hospitalQueue->verificarPaciente($nomePaciente);
            break;
        case '7':
            $nomePaciente = readline("Digite o nome do paciente: ");
            $hospitalQueue->removerPaciente($nomePaciente);
            break;
            
        case 'q':
            echo "Saindo do programa...\n";
            exit();
        default:
            echo "Opção inválida. Tente novamente.\n";
            break;
    }
}
?>
