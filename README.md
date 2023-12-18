
# Sistema_Cadastro

O sistema de cadastro em PHP e MySQL é uma aplicação web desenvolvida para gerenciar informações de usuários, incluindo dados como nome, e-mail, cidade e outros detalhes relevantes. Abaixo estão os principais aspectos do projeto:

## :computer: Tecnologias

**Back-end:** JavaScript, PHP, MySQL, XAMPP.

**Front-end:** HTML/CSS, JavaScript, Bootstrap.

## :warning: Dependências

### É necessário instalar o ambiente de desenvolvimento do PHP, o XAMPP<img src="https://cdn.icon-icons.com/icons2/1381/PNG/512/xampp_94513.png" width="25" height="25">

`https://www.apachefriends.org/download.html`

### Após a instalação, abrir o painel XAMPP e executar APACHE e MYSQL:

<img src="https://media.geeksforgeeks.org/wp-content/uploads/20190719175159/xamppControlPanel.jpg" width="450" height="400">

### Encontrar pasta `htdocs` e anexar o projeto.


## :pushpin: Funcionalidades

- Utilização de um banco de dados MySQL para armazenar e recuperar as informações dos usuários.

- Verificação de campos obrigatórios, formatos válidos de e-mail, entre outras verificações.

- Implementação de validações para garantir que os dados inseridos pelos usuários sejam consistentes e seguros.

- Aplicação de boas práticas de segurança, como o uso de prepared statements para evitar ataques de injeção de SQL.


## :file_folder: Executar Projeto

### Para executar o projeto, copie o seguinte endereço: `http://localhost/` e cole no navegador em que você está acostumado.


<img src="https://apache-windows.ru/wp-content/uploads/2020/03/localhost.png" width="450" height="400">


### Mas antes de executá-lo, abra uma nova guia no navegador e copie o endereço `http://localhost/phpmyadmin/`. Clique na opção `Novo`, criar `Nome da base de dados` com o nome `cadastros`, ir na opção SQL e executar o arquivo SQL do proejto, `cadastros.sql`. 

<img src="https://www.edureka.co/blog/wp-content/uploads/2019/09/Create-New-Database-528x213.png" width="600" height="400">



## Autores

- [@Elias](https://www.github.com/EliasBRodrigues)