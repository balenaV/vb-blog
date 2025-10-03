<?php

namespace app\Core;

class Helpers
{

    /**
     * Válida uma senha criptografada
     * @param string $senha
     * @return bool
     */
    public static function validarSenha(string $senha): bool
    {
        if (!(mb_strlen($senha) >= 6 && mb_strlen($senha) <= 50))
            return false;
        return true;
    }


    /**
     * @param string $senha senha a passar pelo hashing
     * @return $string
     */
    public static function gerarSenha(string $senha): string
    {
        return password_hash($senha, PASSWORD_ARGON2ID);
    }

    /**
     * Valida um número de CPF
     * @param string $cpf
     * @return bool
     */
    public static function validarCpf(string $cpf): bool
    {
        // Remove caracteres que não sejam números
        $cpf = self::limparNumero($cpf);

        // Verifica se tem 11 dígitos ou se são todos iguais (inválido)
        if (strlen($cpf) != 11 || preg_match('/^(.)\1{10}$/', $cpf)) {
            throw new Exception('O CPF precisa ter 11 dígitos');
        }

        // Valida os dois dígitos verificadores
        for ($t = 9; $t < 11; $t++) {
            $soma = 0;
            for ($i = 0; $i < $t; $i++) {
                $soma += $cpf[$i] * (($t + 1) - $i);
            }
            $digito = ((10 * $soma) % 11) % 10;
            if ($cpf[$t] != $digito) {
                throw new Exception("Erro ao validar CPF");
            }
        }

        return true;
    }

    public static function limparNumero(string $numero): string
    {
        return preg_replace('/[^0-9]/', '', $numero);
    }

    /**
     * Resume um texto
     *
     * @param string $texto  texto para resumir
     * @param int $limite  quantidade de caracteres
     * @param string $continue (opcional) - o que deve ser exibido ao final do resumo
     * @return string texto resumido
     */
    public static function resumirTexto(string $texto, int $limite, string $continue = "..."): string
    {
        $textoLimpo = trim(strip_tags($texto));
        if (mb_strlen($textoLimpo) <= $limite) {
            return $textoLimpo;
        }

        $resumirTexto = mb_substr($textoLimpo, 0, mb_strrpos(mb_substr($textoLimpo, 0, $limite), ''));

        return $resumirTexto . $continue;
    }

    public static function formatarValor(?float $valor): string
    {
        return number_format(($valor ?? 0), 2, ',', '.');
    }

    /**
     * Valida um Email
     *
     * @param string $email email a ser validado
     *
     * @return bool resultado da validação do email
     */

    public static function validarEmail(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    /**
     * Valida uma url
     * @param string $url url a ser validada
     * @return bool resultado da validação da url com base de ter ou não os critérios:
     * - .
     * - 10+ caractéres
     * - "http://" ou "https://"
     */
    public static function validaUrl(string $url): bool
    {
        return strlen($url) >= 10
            && str_contains($url, '.')
            && (str_starts_with($url, 'http://') || str_starts_with($url, 'https://'));
    }

    /**
     * Valida uma url utilizando filtro padrao do PHP
     * @param string $url url a ser validada
     * @return bool resultado da validação da url
     */
    public static function validaUrlComFiltro(string $url): bool
    {
        return filter_var($url, FILTER_VALIDATE_URL);
    }

    /**
     * Formata o link completo da url
     * @param string $url url a ser formatada
     * @return string retorna a url formatada como um link completo
     */
    public static function url(string $url): string
    {
        $servidor = filter_input(INPUT_SERVER, 'SERVER_NAME');
        $ambiente = ($servidor == '127.0.0.1') ? URL_DESENVOLVIMENTO . URL_BASE : URL_PRODUCAO . URL_BASE;

        // return $ambiente . $url;

        return str_starts_with($url, '/') ? $ambiente . $url : $ambiente . "/" . $url;
    }

    /**
     * Valida se o site está localhost ou não
     * @return bool resultado da validação
     */
    public static function localhost(): bool
    {
        return filter_input(INPUT_SERVER, 'SERVER_NAME') == '127.0.0.1';
    }

    public static function redirecionar(string $url = null): void
    {
        header('HTTP/1.1 302 Found');

        $local = ($url ? self::url($url) : self::url(null));

        header("Location: $local");
        exit();
    }

    public static function flash(): ?string
    {
        $sessao = new Session();

        if ($flash = $sessao->flash()) {
            echo $flash;
        }

        return null;
    }
}
