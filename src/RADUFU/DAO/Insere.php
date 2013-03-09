<?php
namespace RADUFU\DAO;

use \PDO;

require_once (__DIR__ . '/../Autoloader.php');

class Insere {
    public static function dadosTeste () {
        $insert_categorias = "
            INSERT INTO categoria (categoria_nome) VALUES
            ('Ensino'),('Orientação'),('Produção'),('Pesquisa');
            ";
        $insert_multiplicadores = "
            INSERT INTO multiplicador (multiplicador_nome) VALUES
            ('Aulas / Semana'),('Disciplinas');
            ";
        $insert_tipos = "
            INSERT INTO tipo (tipo_categoria, tipo_descricao, tipo_pontuacao,
                tipo_multiplicador) VALUES

            (1,"."'Aula teórica ou prática de disciplinas ministradas na Educação Básica, na "
                ."Educação Profissional, em cursos de graduação ou pós-graduação stricto e lato "
                ."sensu da UFU, sem remuneração complementar, aprovadas pelo Conselho da "
                ."Unidade. Para disciplinas ministradas por mais de um docente, a pontuação "
                ."deverá ser atribuída ao docente de acordo com a carga horária ministrada pelo "
                ."mesmo. Turmas adicionais da mesma disciplina ministradas pelo docente serão "
                ."pontuadas nos itens 02 e 03.', 10, 1),

            (1,"."'Aula teórica ou prática para turmas adicionais da mesma disciplina, enquadrada "
                ."na Situação 1 (ver OBS.), ou ministrada pelo mesmo docente para Cursos "
                ."oferecidos em turnos distintos.', 10, 1),

            (1,"."'Aula teórica ou prática para turmas adicionais da mesma disciplina, ministrada"
                ."pelo mesmo docente, e no mesmo Curso, enquadrada na Situação 2 (ver OBS.).', 5, 1);
            ";
        $insert_professores = "
            INSERT INTO professor (professor_nome, professor_siape, professor_senha) VALUES
            ('Girafales', '12129idasdas', 'senha');
        ";
        $insert_atividades = "
            INSERT INTO atividade (
                atividade_tipo, atividade_descricao, atividade_datainicio,
                atividade_datafim,
                atividade_multiplicador_valor,
                atividade_professor) VALUES

            (1,"."'Cupcake ipsum dolor sit amet. Faworki jujubes cheesecake "
                ."macaroon halvah cupcake lollipop sweet roll. Cake chocolate wafer "
                ."jujubes fruitcake chocolate. Cookie applicake candy canes. Croissant "
                ."carrot cake caramels chupa chups icing I love bonbon powder. Cake I "
                ."love I love topping marzipan I love.','28/11/2012', '29/11/2012', 6, 1),

            (1, 'Descrição diferente', '29/11/2011', '30/11/2011', 2, 1);
            ";
        $insert_comprovantes = "
            INSERT INTO comprovante (comprovante_arquivo, comprovante_atividade) VALUES
            ('/home/yassin/The X files.pdf', 1),
            ('/home/yassin/Top Secret.pdf', 2);
        ";

        echo "###################################<br/>";
        echo "###### InsereDadosTeste v1.0 ######<br/>";
        echo "###################################<br/>";

        $inserts = array($insert_categorias, $insert_multiplicadores,
                         $insert_tipos, $insert_professores, $insert_atividades,
                         $insert_comprovantes);

        foreach ($inserts as $key => $ins) {
            $stm = Connection::Instance()->get()->prepare($ins);
            $stm->execute();
            echo "at: ". $key . " " . $stm->errorInfo()[2] . "<br/>";
        }

        echo "InserirDadosTeste says: Feito! Aproveite! <br/><br/><br/>";
    }
}
Insere::dadosTeste();
?>