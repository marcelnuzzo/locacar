<?php
$pwd="hello world !";
$pwdCrypte = password_hash($pwd, PASSWORD_DEFAULT);
echo $pwdCrypte;

echo "<hr>";
if (password_verify('bonjour le monde', $pwdCrypte)) {
    echo 'Le mot de passe est valide !';
} else {
    echo 'Le mot de passe est invalide.';
}
echo "<hr>";
if (password_verify($pwd, $pwdCrypte)) {
    echo 'Le mot de passe est valide !';
} else {
    echo 'Le mot de passe est invalide.';
}
?>