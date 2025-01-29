// valida se as senhas coincidem antes de enviar o formulário.

// document.querySelector('form').addEventListener('submit', function (e) {
//     const password = document.getElementById('password').value;
//     const confirmPassword = document.getElementById('confirm-password').value;

//     if (password !== confirmPassword) {
//         e.preventDefault();
//         alert('As senhas não coincidem.');
//     }
// });

// verifica se o cpf é valido
// function 
//     isValidCPF($cpf) {
//     $cpf = preg_replace('/[^0-9]/is', '', $cpf);
//     if (strlen($cpf) != 11) return false;
//     if (preg_match('/(\d)\1{10}/', $cpf)) return false;

//     for ($t = 9; $t < 11; $t++) {
//         for ($d = 0, $c = 0; $c < $t; $c++) {
//             $d += $cpf[$c] * (($t + 1) - $c);
//         }
//         $d = ((10 * $d) % 11) % 10;
//         if ($cpf[$c] != $d) {
//             return false;
//         }
//     }
//     return true;
// }

function formatPhone(input) {
    let value = input.value.replace(/\D/g, ''); // Remove qualquer caractere não numérico

    // Aplica a formatação
    if (value.length <= 10) {
        // Formato (XX) XXXX-XXXX
        value = value.replace(/(\d{2})(\d{4})(\d{4})/, '($1) $2-$3');
    } else {
        // Formato (XX) 9 XXXX-XXXX
        value = value.replace(/(\d{2})(\d{1})(\d{4})(\d{4})/, '($1) $2 $3-$4');
    }

    input.value = value;
}