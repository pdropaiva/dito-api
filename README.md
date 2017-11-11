# dito-api
API simples para cadastrar evento no formato:
{
 "event":"buy",
​ "timestamp":"2016-09-22T13:57:31.2311892-04:00"
}

Para cadastrar, enviar requisição para /event utilizando o método POST, se a requisição vier correta será salvo no banco de dados o evento 
(foi utilizado MongoDB).

A pesquisa do autocomplete deve ser feita para /event/search utilizando o método GET, informando o input search com o conteúdo a ser pesquisado 
(deve ter pelo menos 2 caractéres à pesquisa), serão retornados até 10 resultados.

Para pegar todos os eventos cadastrados de um tipo de evento deve ser informado o evento para /event utilizando o método GET, informando o input search com o evento.