<?php

namespace SRC;

use Exception;

class Funcoes
{
    /*

    Desenvolva uma função que receba como parâmetro o ano e retorne o século ao qual este ano faz parte. O primeiro século começa no ano 1 e termina no ano 100, o segundo século começa no ano 101 e termina no 200.

	Exemplos para teste:

	Ano 1905 = século 20
	Ano 1700 = século 17

     * */
    public function SeculoAno(int $ano): int
    {
        $anoString = (string)$ano;
        $anoLength = strlen($anoString);
        $seculoParte2 = (int)substr($anoString, -2, 2);
        $seculo = (int)substr($anoString, 0,  $anoLength - 2);
        if ($seculoParte2 > 0 || $seculo == 0) {
            $seculo++;
        }

        return  $seculo;
    }









    /*

        Desenvolva uma função que receba como parâmetro um número inteiro e retorne o numero primo imediatamente anterior ao número recebido

        Exemplo para teste:

        Numero = 10 resposta = 7
        Número = 29 resposta = 23
        E quando for o numero 2?

         * */
    public function PrimoAnterior(int $numero): int
    {
        if ($numero == 2) {
            throw new Exception("Intervalo invalido");
        };
        $primo = 2;
        $ePrimo = false;
        for ($i = $numero - 1; $i > 0; $i--) {
            if ($this->EPrimo($i)) {
                $primo = $i;
                break;
            }
        }
        return $primo;
    }

    private function EPrimo(int $numero): bool
    {
        for ($d = 2; $d <  $numero; $d++) {
            if ($numero % $d == 0) {
                return false;
            }
        }
        return true;
    }
    /*

        Desenvolva uma função que receba como parâmetro um array multidimensional de números inteiros e retorne como resposta o segundo maior número.

        Exemplo para teste:

    	Array multidimensional = array (
    	array(25,22,18),
    	array(10,15,13),
    	array(24,5,2),
    	array(80,17,15)
    	);

    	resposta = 25

         * */
    public function SegundoMaior(array $arr): int
    {
        $arrayUnidimensional = $this->arrayUnidimensional($arr);
        $arrayOrdenado = $this->orderNaArray($arrayUnidimensional);

        return  $arrayOrdenado[count($arrayOrdenado) - 2];
    }

    private function arrayUnidimensional(array $arr): array
    {
        $arrayUnidimensional = [];
        foreach ($arr as $key) {

            $arrayUnidimensional = array_merge($arrayUnidimensional, $key);
        }
        return $arrayUnidimensional;
    }

    private function orderNaArray(array $arr): array
    {
        sort($arr);
        return $arr;
    }



    /*
       Desenvolva uma função que receba como parâmetro um array de números inteiros e responda com TRUE or FALSE se é possível obter uma sequencia crescente removendo apenas um elemento do array.

    	Exemplos para teste 

    	Obs.:-  É Importante  realizar todos os testes abaixo para garantir o funcionamento correto.
             -  Sequencias com apenas um elemento são consideradas crescentes

        [1, 3, 2, 1]  false
        [1, 3, 2]  true
        [1, 2, 1, 2]  false
        [3, 6, 5, 8, 10, 20, 15] false
        [1, 1, 2, 3, 4, 4] false
        [1, 4, 10, 4, 2] false
        [10, 1, 2, 3, 4, 5] true
        [1, 1, 1, 2, 3] false
        [0, -2, 5, 6] true
        [1, 2, 3, 4, 5, 3, 5, 6] false
        [40, 50, 60, 10, 20, 30] false
        [1, 1] true
        [1, 2, 5, 3, 5] true
        [1, 2, 5, 5, 5] false
        [10, 1, 2, 3, 4, 5, 6, 1] false
        [1, 2, 3, 4, 3, 6] true
        [1, 2, 3, 4, 99, 5, 6] true
        [123, -17, -5, 1, 2, 3, 12, 43, 45] true
        [3, 5, 67, 98, 3] true

         * */

    public function SequenciaCrescente(array $arr): bool
    {
        $podeSerOrdenado = false;
        $removidos = 0;
        $numeroAnterio = -INF;
        //[10, 1, 2, 3, 4, 5]
        for ($i = 0; $i < count($arr); $i++) {
            if ($arr[$i] > $numeroAnterio) {
                $numeroAnterio = $arr[$i];
            } else {
                $arrSemAtual = $arr;
                array_splice($arrSemAtual, $i, 1);
                $ordemSemAtual = $this->VerificaOrdemCrescente($arrSemAtual);

                $arrSemAnterior = $arr;
                array_splice($arrSemAnterior, $i - 1, 1);
                $ordemSemAnterior = $this->VerificaOrdemCrescente($arrSemAnterior);
                $podeSerOrdenado =  $ordemSemAtual || $ordemSemAnterior;
                break;
            }
            // var_dump($arr[$i]);
        }

        return  $podeSerOrdenado;
    }

    private function VerificaOrdemCrescente(array $arr): bool
    {
        $podeSerOrdenado = true;
        $numeroAnterio = -INF;
        for ($i = 0; $i < count($arr); $i++) {

            if ($arr[$i] < $numeroAnterio || $arr[$i] == $numeroAnterio) {
                $podeSerOrdenado = false;
                break;
            }
            $numeroAnterio = $arr[$i];
        }
        return  $podeSerOrdenado;
    }
}

$multidimensional = array(
    array(25, 22, 18),
    array(10, 15, 13),
    array(24, 5, 2),
    array(24, 17, 12)
);

var_dump((new Funcoes())->SequenciaCrescente([1, 3, 2, 1]) == false);
var_dump((new Funcoes())->SequenciaCrescente([1, 3, 2]) == true);
var_dump((new Funcoes())->SequenciaCrescente([1, 2, 1, 2]) == false);
var_dump((new Funcoes())->SequenciaCrescente([3, 6, 5, 8, 10, 20, 15]) == false);
var_dump((new Funcoes())->SequenciaCrescente([1, 1, 2, 3, 4, 4]) == false);
var_dump((new Funcoes())->SequenciaCrescente([1, 4, 10, 4, 2]) == false);
var_dump((new Funcoes())->SequenciaCrescente([10, 1, 2, 3, 4, 5]) == true);
var_dump((new Funcoes())->SequenciaCrescente([1, 1, 1, 2, 3]) == false);
var_dump((new Funcoes())->SequenciaCrescente([0, -2, 5, 6]) == true);
var_dump((new Funcoes())->SequenciaCrescente([1, 2, 3, 4, 5, 3, 5, 6]) == false);
var_dump((new Funcoes())->SequenciaCrescente([40, 50, 60, 10, 20, 30]) == false);
var_dump((new Funcoes())->SequenciaCrescente([1, 1]) == true);
var_dump((new Funcoes())->SequenciaCrescente([1, 2, 5, 3, 5]) == true);
var_dump((new Funcoes())->SequenciaCrescente([1, 2, 5, 5, 5]) == false);
var_dump((new Funcoes())->SequenciaCrescente([10, 1, 2, 3, 4, 5, 6, 1]) == false);
var_dump((new Funcoes())->SequenciaCrescente([1, 2, 3, 4, 3, 6]) == true);
var_dump((new Funcoes())->SequenciaCrescente([1, 2, 3, 4, 99, 5, 6]) == true);
var_dump((new Funcoes())->SequenciaCrescente([123, -17, -5, 1, 2, 3, 12, 43, 45]) == true);
var_dump((new Funcoes())->SequenciaCrescente([3, 5, 67, 98, 3]) == true);
