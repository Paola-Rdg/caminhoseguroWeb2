# Caminho Seguro Web

## Descrição do Projeto
O Caminho Seguro Web é um site educativo e interativo desenvolvido com o objetivo de traduzir as normas do Código de Trânsito Brasileiro (CTB) para uma linguagem acessível, visual e dinâmica[span_0](start_span)[span_0](end_span). A plataforma é voltada para jovens pedestres, ciclistas e futuros motoristas, utilizando recursos pedagógicos baseados em gamificação, como quizzes, simulações de situações reais e navegação direcionada por perfil de usuário[span_1](start_span)[span_1](end_span)[span_2](start_span)[span_2](end_span). O projeto busca tornar o aprendizado sobre educação no trânsito mais atrativo e efetivo, visando reduzir comportamentos de risco nas vias públicas por meio da conscientização digital[span_3](start_span)[span_3](end_span). 

## Membros da Equipe
* Paola de Azevedo Rodrigues[span_4](start_span)[span_4](end_span)
* Pedro Henrique Prates Almeida[span_5](start_span)[span_5](end_span)
* Sarah Victoria Soares Farias[span_6](start_span)[span_6](end_span)
* Thalisson Caio Ribeiro Santos[span_7](start_span)[span_7](end_span)

## Instruções de Execução
1. Certifique-se de possuir um ambiente de desenvolvimento local (como XAMPP) com suporte a PHP e MySQL.
2. Clone o repositório do projeto para dentro do diretório público do seu servidor (ex: `htdocs` no XAMPP).
3. Importe o script de criação do banco de dados (localizado na pasta `database/`) para o seu servidor MySQL.
4. Ajuste as credenciais de acesso ao banco de dados no arquivo de conexão da aplicação (usuário predefinido como `root` e sem senha no XAMPP).
5. Inicie os serviços do Apache e MySQL no seu servidor local.
6. Acesse a aplicação pelo navegador apontando para a pasta pública do projeto (ex: `http://localhost/caminho-seguro-web/public/`).

## Divisão Inicial de Tarefas
* **Sarah Victoria Soares Farias**: Criação do repositório no Git, configuração do arquivo README.md e gestão da documentação inicial.
* **Paola de Azevedo Rodrigues**: Estruturação inicial dos diretórios do projeto e implementação do ponto de entrada principal seguindo a arquitetura MVC.
* **Thalisson Caio Ribeiro Santos**: Implementação do template base utilizando Bootstrap, configuração dos arquivos estáticos (CSS/JS) e estruturação das Views principais.
* **Pedro Henrique Prates Almeida**: Configuração inicial de roteamento, estruturação de convenções (Namespaces) e implementação do primeiro Controller de teste.
