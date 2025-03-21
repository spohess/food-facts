## Diário do projeto

- **17/03/2025**: Fiz a instalação de um novo projeto Laravel e utilizarei o pacote Sail;
- **17/03/2025**: Pesquisei sobre manter o Laravel com o MongoDB como único banco de dados, não encontrei nada reportando que não era uma boa ideia, mas, por fins demonstrativos, achei interessante deixar 2 bancos para mostrar como eu trabalho com projeto multi databases;
- **17/03/2025**: Consultei a documentação do laravel para configuração do driver do mongodb e instalação do pacote do MongoDB;
- **17/03/2025**: Tive que publicar os arquivos do docker do Sail e alterar a criação da imagem para instalar a versão correta da extensão do mongodb que estava gerando incompatibilidade no projeto;
- **17/03/2025**: O pacote Sanctum foi instalado e configurado para segurança da API;
- **18/03/2025**: O download dos arquivos serão feitos através de jobs, fiquei em dúvida de fazer no evento da criação do ImportControl, mas acredito que direto por job é mais fácil o entendimento/manutenção;
- **18/03/2025**: Para a leitura do arquivo fo utilizado a extenção zlib, ela é padrão da maioria das instalações, mas deixei como dependência no composer.json. Preferi fazer assim do que utilizar intermédio do SO, por iriá criar um depedência muito maior do que usar a extenção;
- **18/03/2025**: A imagem do mongoDB foi alterada pois a imagem da Atlas estava dando muito problema de timeout;
- **18/03/2025**: Apesar de não ter usado exec na descompactação do arquivo acabei usando na endpoint de status por ter achado mais simples e limpo fazer com uptime e free;
- **19/03/2025**: Na criação dos testes percebi que o mongodb estava sem base de teste, então adicionei mais uma base no docker-compose e criei um arquivo de env para o ambiente de teste;

# Projeto
Este projeto é a resultado deste [teste](https://github.com/coodesh/products-parser-20230105)

## Execução
Projeto está em laravel 12 com o pacote Sail, para executálo após clonar o projeto execute os comandos abaixo:

### .env
````
cp .env.example .env
````

### Docker
````
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php84-composer:latest \
    composer install --ignore-platform-reqs
````

### Sail
````
sail build
sail up -d
````

### Key
````
sail artisan key:generate
````

### Migration
````
sail artisan migrate --seed
````

## Funcionamento do sistema
Para o operacional do sistema siga as instruções abaixo:

### Start da fila *prompt ficará travado*
````
sail artisan queue:work
````

### Importação
````
sail artisan etl:import-producst
````

## API
Para documentação da API acesse: [Swagger](http://localhost/api/documentation)

## Notificação
Para verificar notificações de falha acesso [Mailpit](http://localhost:8025)

### Atalho notificação
Para facilitar o teste de notificação foi criado um endpoint
````
curl --location --request PUT 'http://localhost/api/import/fail'
````