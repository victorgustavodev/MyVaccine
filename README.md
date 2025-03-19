# MyVaccine - Sistema de Vacinação Pública Digital 💉

O **MyVaccine** é uma plataforma digital destinada a facilitar o acesso, o agendamento e o acompanhamento das vacinas públicas. O sistema visa otimizar a gestão de campanhas de vacinação, promovendo a educação em saúde e melhorando a comunicação entre cidadãos e unidades de saúde.

<!--
<br><br>
![image](https://github.com/user-attachments/assets/745a28de-c486-42d9-893f-6f59a072f7e8)
<br><br>
 -->

## 🛠️ Tecnologias Utilizadas
[![Techonologies](https://skillicons.dev/icons?i=php,mysql,tailwindcss,js,html,css,figma,git,vscode)](https://skillicons.dev)

## Benefícios 👍
- **Acessibilidade**: Facilita o acesso à vacinação e informações sobre vacinas.
- **Eficiência**: Reduz filas e otimiza o tempo de espera com agendamentos prévios.
- **Integração Familiar**: Permite o gerenciamento de vacinas para toda a família.

## 🌟 Funcionalidades Principais

- **Cadastro de Usuários**: Cadastro de cidadãos com informações pessoais e de contato;
- **Login Seguro**: Acesso via CPF e senha, com recuperação de senha;
- **Histórico de Vacinação**: Registro das vacinas aplicadas no usuário;
- **Localização dos postos de saúde**: É possivel filtrar e buscar os postos pelo Estado e Cidade.
- **Painel de controle (Admin)**: O adm tem total controle da criação e edição de postos e vacinas;
- **Gerenciamento de estoque (Admin)**: Através do painel é possivel gerenciar os estoque e adicionar vacinas por lote;
- **Aplicação de vacina (Admin)**: Com o cpf do usuário é possivel aplicar a vacina e automaticamente remover do estoque.


# Como Executar o Projeto

## Utilizando o XAMPP
 <img src="https://img.shields.io/badge/Xampp-F37623?style=for-the-badge&logo=xampp&logoColor=white" />   

1.  **Clone este repositório:**
    Abra o terminal ou prompt de comando e execute o comando:
    ```bash
    git clone [https://github.com/](https://github.com/)[seu_usuario]/myvaccine.git
    ```

2.  **Abra o XAMPP e inicie os módulos Apache e MySQL.**

3.  **Mova o repositório clonado para a pasta `htdocs` do seu diretório do XAMPP:**
    O caminho normalmente é `C:\xampp\htdocs` (no Windows) ou `/opt/lampp/htdocs` (no Linux/Mac).

4.  **Importe o banco de dados:**
    * Abra o phpMyAdmin acessando `http://localhost/phpmyadmin/`.
    * Crie um novo banco de dados ou use um já existente.
    * Importe o arquivo `db.sql`, que está localizado na pasta `config/` do seu projeto.

5.  **Acesse a URL de administração e faça login:**
    * Abra o navegador e acesse `http://localhost/my-vaccine/admin`.
    * Use o usuário e senha definidos por padrão no banco de dados (ou altere-os diretamente no MySQL).

6.  **Acesse a aplicação:**
    No navegador, vá para:
    ```perl
    http://localhost/my-vaccine/index.php
    ```

## Sem o XAMPP

1.  **Clone este repositório:**
    Abra o terminal ou prompt de comando e execute o comando:
    ```bash
    git clone [https://github.com/](https://github.com/)[seu_usuario]/myvaccine.git
    ```

2.  **Instale as dependências necessárias:**
    * Instale o PHP no seu sistema.
    * Instale o MySQL ou use outro banco de dados compatível.

3.  **Configure o banco de dados:**
    * Crie um banco de dados no MySQL.
    * Importe o arquivo `db.sql`, localizado na pasta `config/` do seu projeto.
    * Altere as configurações de banco de dados no arquivo `config/db.php`:
        * Defina as credenciais de conexão do banco de dados.

4.  **Acesse a aplicação:**
    * Inicie o servidor PHP com o comando:
        ```nginx
        php -S localhost:8000
        ```
    * No navegador, acesse:
        ```bash
        http://localhost:8000/index.php
        ```

Isso deve ser o suficiente para rodar o projeto em ambas as formas. Se tiver alguma dúvida ou algo não funcionar, é só avisar!

## 📂 Estrutura do Projeto

- `admin`: Rotas de usuário admin.
- `assets`: Estilos e scripts.
- `config`: Arquivos SQL.
- `pages`: Paginas de autenticação do paciente
- `patients`: Aplicação de vacina - admin
- `posts`: Gerenciamento de postos - admin
- `routes`: Autenticação e conexao com banco de dados
- `stocks`: Gerenciamento de estoque - admin
- `vaccine`: Gerenciamento de vacinas - admin

## 📜 Licença

Este projeto está licenciado sob a Licença MIT. Consulte o arquivo [📜 LICENSE](LICENSE) para mais detalhes.

---

## 💼 Colaboradores

- Camila Lídia ( Prototipação )
- Hatus Luiz ( Product Owner )
- Luiz Fernando ( Scrum Master )
- Rafael José ( Front-End )
- Victor Gustavo ( Full-Stack )



<!--Desenvolvido por [Victor Gustavo](https://github.com/victorgustavodev).-->



