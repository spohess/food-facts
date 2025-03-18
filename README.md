## Diário do projeto

- **17/03/2025**: Fiz a instalação de um novo projeto Laravel e utilizarei o pacote Sail;
- **17/03/2025**: Pesquisei sobre manter o Laravel com o MongoDB como único banco de dados, não encontrei nada reportando que não era uma boa ideia, mas, por fins demonstrativos, achei interessante deixar 2 bancos para mostrar como eu trabalho com projeto multi databases;
- **17/03/2025**: Consultei a documentação do laravel para configuração do driver do mongodb e instalação do pacote do MongoDB;
- **17/03/2025**: Tive que publicar os arquivos do docker do Sail e alterar a criação da imagem para instalar a versão correta da extensão do mongodb que estava gerando incompatibilidade no projeto;
- **17/03/2025**: O pacote Sanctum foi instalado e configurado para segurança da API;
- **18/03/2025**: O download dos arquivos serão feitos através de jobs, fiquei em dúvida de fazer no evento da criação do ImportControl, mas acredito que direto por job é mais fácil o entendimento/manutenção;
- **18/03/2025**: Para a leitura do arquivo fo utilizado a extenção zlib, ela é padrão da maioria das instalações, mas deixei como dependência no composer.json. Preferi fazer assim do que utilizar intermédio do SO, por iriá criar um depedência muito maior do que usar a extenção;