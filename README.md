![Código Fonte do Site 3º Encontro Gamer De Pará de Minas. Vue + Webpack](https://user-images.githubusercontent.com/25160385/57738272-2d0c0080-7685-11e9-80a9-756e1e97dc9a.jpg)

## Do que se trata?
Este é o repositório da Api desenvolvida para alimentar o site do Terceiro Encontro Gamer de Pará de Minas e o CMS responsável por tornar as informações do site dinâmicas.
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
A configuração da aplicação pode ser realizada de duas maneiras distintas.

### Configuração por interface
A configuração por interface, foi construída para facilitar o processo de instalação e configuração da Api, para isto, acesse a seguinte rota com o projeto já instalado.

```
/Start
```

Por exemplo http://api.egpm.com.br/**Start**

Será aberto uma página pra realização da configuração. Siga os passos até obter a mensagem de sucesso.

####❗ Importante
Ao realizar a autoconfiguração, é necessário ter o conhecimento que:
* O arquivo de configuração do sistema pode existir (Arquivo demonstrado no próximo método)
* Todas as tabelas do banco serão gerados automáticamente, isto se a tabela não existir, se você já tem uma base de dados configurada, não use este método.
* O script se encarregará de gerar todos os dados iniciais do sistema
* O usuário administrador (admin) será criado automaticamente com a senha informada
* O arquivo de configuração desmonstrado no método abaixo, será gerado automáticamente

### Configuração por arquivo
Você deverá adicionar as informações do seu banco no arquivo de configurações do projeto

```
├── api-egpm
│   └── config
│       │── config (Não versionado)
│       │── DataBaseStructure.sql
│       └── config.example
```

Você deverá gerar em seu projeto, um arquivo com um nome **config**, sem extensão de arquivo, utilize o **config.example**
para isso.

```
[bd];
st_name: PRIMARIO;
st_user: nome_usuario;
st_password: nome_senha;
st_dbname: nome_banco;
st_host: nome_host;

[config];
st_operacao: DEV;
nu_minutossessao: 30;
st_senhacapcha: chaveReCAPTCHA;
st_key: JDIVGKOWDGVDGJDPSIFJ;
```

* **st_name**: Nome de identificação do Banco de Dados (Mantenha o Padrão PRIMARIO)
* **st_user**: Nome do usuário do banco
* **st_password**: Senha do usuário adicionado anteriormente
* **st_dbname**: Nome da base de dados
* **st_host**: Host servidor da base de dados


* **st_operacao**: Indica se a aplicação está em desenvolimento ou produção: 
Use DEV para desenvolvimento e PRO para produção
* **nu_minutossessao**: Tempo de duração das sessões dos usuários
* **st_senhacapcha**: Chave secreta do reCAPTCHA
* **st_key**: Chave utilizada para geração de senhas pelo sistema (Não deve ser alterada após sua primeira definição)

####❗ Importante
 * Para este modo de configuração você irá precisar criar as tabelas do banco de dados da aplicação manualmente.

 * O script para crição se encontra na mesma pasta do arquivo de configuração **DataBaseStructure.sql**

 * Também será necessário criar na base de dados alguns itens necessários para o funcionamento da aplicação, para isto execute o arquivo
DataBaseStartData.sql.

 * Após será necessário a criação do usuário administrador.

      * Realize o INSERT manual do usuário no banco
      * Utilize um email válido ao realizar a inserção, ele será necessário para recuperação da senha.
      * Não se importe com a definição da senha, como o sistema utiliza criptografia, será necessário sua alteração por meio deste.
      * Feito isso, será necessário recuperar a senha para que ela seja gerada utilizando a cheve de criptogarafia.
      * Processo de recuperação em Desenvolvimento

### Migração de ambientes
Caso exista a necessidade de migração, atente-se ao seguintes detalhes
* A st_key do arquivo de configuração deve ser a mesma em ambos os ambientes.
* Altere os dados do banco de dados
* As imagens serão buscadas no antigo domínio de aplicação. (Issue já criada para correção)
* Realize somente o procedimento de instalação.

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
