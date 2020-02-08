![Código Fonte da API 3º Encontro Gamer De Pará de Minas.](https://user-images.githubusercontent.com/25160385/73674435-40d21980-468f-11ea-9efc-b1b5d3882953.jpg)

## Indíce

* [Do que se trata? ](https://github.com/Lucasmg37/api-egpm/tree/read.me#do-que-se-trata)
* [Requisitos do servidor](https://github.com/Lucasmg37/api-egpm/tree/read.me#requisitos-do-servidor)
* [Requisitos para instalação](https://github.com/Lucasmg37/api-egpm/tree/read.me#requisitos-para-instala%C3%A7%C3%A3o)
* [Instalando o projeto](https://github.com/Lucasmg37/api-egpm/tree/read.me#instalando-o-projeto)
* [Configuração](https://github.com/Lucasmg37/api-egpm/tree/read.me#configura%C3%A7%C3%A3o)
    * [Configuração por interface](https://github.com/Lucasmg37/api-egpm/tree/read.me#configura%C3%A7%C3%A3o-por-interface)
    * [Configuração por arquivo](https://github.com/Lucasmg37/api-egpm/tree/read.me#configura%C3%A7%C3%A3o-por-arquivo)
    * [Migração de ambientes](https://github.com/Lucasmg37/api-egpm/tree/read.me#migra%C3%A7%C3%A3o-de-ambientes)
* [Desenvolvimento](https://github.com/Lucasmg37/api-egpm/tree/read.me#desenvolvimento)
* [Deploy](https://github.com/Lucasmg37/api-egpm/tree/read.me#deployo)


## Do que se trata?
Este é o repositório da API desenvolvida para alimentar o site do Terceiro Encontro Gamer de Pará de Minas e o CMS responsável por tornar as informações do site dinâmicas.
Desenvolvida em framework próprio, [Nome Framework](https://github.com/Lucasmg37/pesquisa_de_satisfacao_back/tree/framework/master), utilizando PHP e seguindo o padrão Rest.

Projeto desenvolvido em conjunto com Marcus Pereira e Eduardo, em disciplina interdisciplinar do curso Gestão de Tecnologia da Informação da FAPAM (Faculdade de Pará de Minas).

## Requisitos do servidor
- PHP 7.0
- MySQL version 10.2
- Servidor de Web (Apache, LiteSpeed)

Essas são as configurações utilizadas no desenvolvimento da aplicação, não sendo obrigatório o uso das tecnologias indicadas,
 caso ocorra algum erro com outras versões das aplicações, criar uma issue para análise e correções.
 
 Para ambiente de testes local, recomendo o uso do Wamp ou Xamp.


## Requisitos para instalação
-  [Composer](https://getcomposer.org/)

O Composer é utilizado no projeto na gestão de dependências e no autoload das classes.


## Instalando o projeto
- Certifique de estar em um abiente com o Composer e PHP instalados
- Faça o clone do repositório
- Abra o terminal de sua preferência, navegue até a pasta do projeto e execute o seguinte comando

```
composer install
```
Esse comando baixa e instala as dependências necessárias utilizadas no projeto e configura o autoload.

## Configuração
A configuração da aplicação pode ser realizada de duas maneiras distintas, abordaremos aqui a configuração por interface, construída para facilitar o processo.

### Configuração por interface
A configuração por interface, foi construída para facilitar o processo de instalação e configuração da API, para isto, acesse a seguinte rota com o projeto já instalado.

```
/Start
```

Por exemplo http://API.egpm.com.br/**Start**

Será aberto uma página pra realização da configuração. 
Siga os passos até obter a mensagem de sucesso.
Preencha todos os dados de acordo com o seu ambiente.

#### ❗ Importante
Ao realizar a autoconfiguração, é necessário ter o conhecimento que:
* O arquivo de configuração do não sistema pode existir (Arquivo demonstrado a seguir)
* Todas as tabelas do banco serão gerados automáticamente, isto se a tabela não existir, se você já tem uma base de dados configurada, confira as observações no tópico **Migração**.
* O script se encarregará de gerar todos os dados iniciais do sistema
* O usuário administrador (admin) será criado automaticamente com a senha informada.
* O arquivo de configuração desmonstrado no método abaixo, será gerado automáticamente

### Arquivo de configuração
O método de auto instalação, irá gerar o arquivo básico de configuração do sistema.

É por meio deste arquivo que o sistema instancia a conexão com o banco de dados, e realiza os envios de emails.

```
├── api-egpm
│   └── config
│       │── config (Não versionado)
│       │── DataBaseStructure.sql
│       └── config.example
```

O arquivo de configuração terá o nome **config**, sem extensão de arquivo, o **config.example**, é usado para exemplos caso 
seja necessário realizar a configuração manualmente.

```
[bd];
st_name: PRIMARIO;
st_user: nome_usuario;
st_password: nome_senha;
st_dbname: nome_banco;
st_host: nome_host;

[email];
host: endereço_smtp;
port: 857;
username: usuario_servidor_email;
password: senha_servidor_email;
SMTPSecure: tls;
SMTPAuth: 1;
IsSMTP: 1;
from: email_de_envio;
replyTo: email_de_resposta;

[config];
st_operacao: DEV;
nu_minutossessao: 30;
st_senhacapcha: chaveReCAPTCHA;
st_key: JDIVGKOWDGVDGJDPSIFJ;
```
**[bd]**

Configurações do banco de dados utilizado para o gerenciamento dos dados.

* **st_name**: Nome de identificação do Banco de Dados (Mantenha o Padrão PRIMARIO)
* **st_user**: Nome do usuário do banco
* **st_password**: Senha do usuário adicionado anteriormente
* **st_dbname**: Nome da base de dados
* **st_host**: Host servidor da base de dados

**[email]**

Configurações do servidor de eamil utilizado para enviar emails do sistema, como recuperação de senha.

* **host**: Endereço do host do servidor smtp
* **port**: Porta responsável pelo serviço;
* **username**: Email de acesso ao servidor de email;
* **password**: Senha do email informado para acesso ao servidor de email;
* **SMTPSecure**: Tipo de protocolo tls|ssl;
* **SMTPAuth**: Utiliza SMTPAuth 1|0;
* **IsSMTP**: Utiliza SMTP 1|0;
* **from**: Email que será utilizado para enviar os emails;
* **replyTo**: Email por onde serão encaminhadas as respostas;

**[config]**

Configurações de funcionamento do sistema.

* **st_operacao**: Indica se a aplicação está em desenvolimento ou produção: 
Use DEV para desenvolvimento e PRO para produção
* **nu_minutossessao**: Tempo de duração das sessões dos usuários
* **st_senhacapcha**: Chave secreta do reCAPTCHA
* **st_key**: Chave utilizada para geração de senhas pelo sistema (Não deve ser alterada após sua primeira definição)

#### ❗ Atenção
Não é recomendado a configuração manual deste sistema, visto que:
* Será necessário a criação de itens iniciais no banco de dados, que são específicos para o seu funcionamento.
    * Criação de Tipos de Usuário (tb_tipousuario) (Consulte: App/Constantes/TipoUsuario.php);
    * Criação de Usuário inicial (tb_usuarios);
    * Criação de Seções bases (tb_secao);
   
* Necessário a criação da base de dados. O script para crição se encontra na mesma pasta do arquivo de configuração **DataBaseStructure.sql**
* As senhas do banco de dados utilizam criptografia, portanto somente o sistema consegue validá-las.
    * Uma maneira de alterar a senha de um usuário deixando a válida, é recuperando a senha do usuário pelo sistema.

### Migração de ambientes
Em caso de migração, realize a instalação conforme o tópico  [Instalando o projeto](https://github.com/Lucasmg37/api-egpm/tree/read.me#instalando-o-projeto)

*Migração com clone da base dados
    * Altere as informações do arquivo de configuração conforme o seu novo ambiente
    * Altere a st_key do arquivo de configuração, para a mesma do projeto a ser migrado.
     * A pasta **Files** que está na raiz do projeto, deverá ser copiada ou movida para o novo servidor.

* Migração com base de dados limpa
    * Configure o projeto conforme o tópico   [Configuração por interface](https://github.com/Lucasmg37/api-egpm/tree/read.me#configura%C3%A7%C3%A3o-por-interface)
    * Altere a st_key do arquivo de configuração, para a mesma do projeto a ser migrado.
    * Limpe as tabelas (tb_usuarios, tb_tipousuarios, tb_secao) no banco recem criado.
    * Importe as informações do banco anterior para o novo banco
    * A pasta **Files** que está na raiz do projeto, deverá ser copiada ou movida para o novo servidor.

#### ❗ Considerções

```
├── api-egpm
│   └── Files
```
A pasta **Files** é responsável por salvar todas as imagens upadas no sistema, e não é versionada.
Em caso de migrações, ela deve ser levada para o novo servidor do projeto manualmente. Vale ressaltar que a mesma está
atrelada a base de dados.

## Desenvolvimento
Para criar novas funcionalidades no projeto, é importante se atentar a alguns detalhes.

A documentação completa das funcionalidades do sistemas, estão presentes em seu respositório base 
[Nome Framework](https://github.com/Lucasmg37/pesquisa_de_satisfacao_back/tree/framework/master).

## Deploy
Para realizar o deploy de sua aplicação, envie os arquivos do projeto para o seu servidor.
A pasta **vendor** não deve ser enviada, visto que utilizaremos o composer para instalar as depedências do projeto.

Com o projeto no servidor, realize os passos de instalação e configuração.

O dominío ou sub dominío do seu website deve estar direcionado para a pasta **public** onde está o arquivo de inicialização da API.

```
├── api-egpm
│   └── public
│       |── .htaccess
│       └── index.php
```

Caso seja necessário configure o **.htaccess** para o correto funcionamento das rotas.

Atualmente o .htaccess está configurado da seguinte forma.

```
RewriteEngine on
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php/$1 [L]
```
