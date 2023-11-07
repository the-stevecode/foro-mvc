<?php
final class AuthModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function login($username, $password)
    {

        try {
            $pdo = $this->db->connect();
            $query = $pdo->prepare('SELECT * FROM usuario WHERE usuario = :usuario');
            $query->execute(['usuario' => $username]);

            if ($query->rowCount() > 0) {
                $item = $query->fetch(PDO::FETCH_ASSOC);

                $user = new UserModel;
                $user->from($item);


                if (password_verify($password, $user->getPassword())) {

                    return $user->getId();
                }else{
                    return false;
                }
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }
    }
}
