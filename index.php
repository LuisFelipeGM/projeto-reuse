<?php
// SETS
require __DIR__ . "/vendor/autoload.php";

use CoffeeCode\Router\Router;

$router = new Router(ROOT);

/* Controllers */
// definindo a namespace dos Controllers
$router->namespace("Src\App");

// Controller Web
// WEB
$router->group(null);
$router->get("/", "WebController:home");

// LOGIN
$router->group("login");
$router->get("/", "WebController:formLogin");
$router->get("/cadastre-se", "WebController:formRegister");
$router->get("/termosdeuso", "WebController:termosdeuso");

// DOADOR
$router->group("doador");
$router->get("/", "DoadorController:home");
$router->get("/configuracao/{cd_usu}", "DoadorController:config");
$router->post("/configuracao/salvar1/{cd_usu}", "DoadorController:configSalvar1");
$router->post("/configuracao/salvar2/{cd_usu}", "DoadorController:configSalvar2");
$router->post("/configuracao/excluir/{cd_usu}", "DoadorController:excluir");
$router->get("/mapa", "DoadorController:maps_dashboard");
$router->get("/mapa/{0}", "DoadorController:maps_dashboard");

// COLABORADOR
$router->group("colaborador");
$router->get("/", "ColaboradorController:home");
$router->get("/configuracao/{cd_usu}", "ColaboradorController:config");
$router->post("/configuracao/salvar3/{cd_usu}", "ColaboradorController:ConfigSalvar3");
$router->post("/configuracao/salvar4/{cd_usu}", "ColaboradorController:ConfigSalvar4");
$router->post("/configuracao/excluir/{cd_usu}", "ColaboradorController:excluir");
$router->get("/mapa", "ColaboradorController:maps_dashboard");
$router->get("/mapa/{0}", "ColaboradorController:maps_dashboard");



// ADMIN
$router->group("admin");
$router->get("/", "AdminController:home");
$router->get("/usuario/{cd_usu}", "AdminController:user");
$router->post("/usuario/salvar/{cd_usu}", "AdminController:SaveUser");

// AUTH
$router->group("authentication");
$router->post("/logon", "Auth:logon");
$router->get("/logoff", "Auth:logoff");
$router->post("/register", "Auth:register");

// ERROS
$router->group("erro");
$router->get("/{errcode}", "WebController:error");
$router->get("/usuarioinativo", "WebController:usuarioInativo");
$router->get("/errocadastro", "WebController:erroCadastro");
$router->get("/errosenha", "WebController:erroSenha");
$router->dispatch();
if ($router->error()) {
    $router->redirect("/erro/{$router->error()}");
}
