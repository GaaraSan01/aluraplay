<?php

namespace Alura\Mvc\Controller;

use Alura\Mvc\Helper\FlashMessageTrait;
use Nyholm\Psr7\Response;
use PDO;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class LoginController implements RequestHandlerInterface
{
    use FlashMessageTrait;
    private PDO $pdo;

    public function __construct()
    {
        $dbPath = __DIR__ .  '/../../banco.sqlite';
        $this->pdo = new PDO("sqlite:$dbPath");
    }

    public function handle(ServerRequestInterface $response): ResponseInterface
    {
        $queryBody = $response->getParsedBody();
        $email = filter_var($queryBody['email'], FILTER_VALIDATE_EMAIL);
        $password = filter_var($queryBody['password']);
        $sql = 'SELECT * FROM users WHERE email = ?;';
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $email);
        $statement->execute();

        $userData = $statement->fetch(PDO::FETCH_ASSOC);
        $correctPassword = password_verify($password, $userData['password'] ?? '');

        if(password_needs_rehash($userData['password'], PASSWORD_ARGON2ID)){

            $statement = $this->pdo->prepare('UPDATE users SET password = ? WHERE id = ?;');
            $statement->bindValue(1, password_hash($password, PASSWORD_ARGON2I));
            $statement->bindValue(2, $userData['id']);
            $statement->execute();
            
        }

        if($correctPassword){
            $_SESSION['logado'] = true;
            return new Response(302, [
                'Location'=> '/'
            ]);
        } else {
            $this->addMessage('Usuário ou senha inválidos!');
            return new Response(302, [
                'Location'=> '/login'
            ]);
        }
    }
}