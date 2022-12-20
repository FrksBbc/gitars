<?php

require __DIR__ . '/vendor/autoload.php';

use App\Lib\App;
use App\Lib\Router;
use App\Lib\Request;
use App\Lib\Response;
use App\Controller\Home;
use App\Controller\GitarokController;
use App\Model\GitarokDao;

Router::get('/', function () {
    (new Home())->indexAction();
});

Router::get('/guitars', function (Request $req, Response $res) {
    return ((new GitarokController())->list());
});

Router::get('/guitarAdd', function (Request $req, Response $res) {
    (new GitarokController())->add();
});

Router::post('/guitarAdd', function (Request $req, Response $res) {
    (new GitarokController())->save();
});

Router::get('/guitarEdit/([0-9]*)', function (Request $req, Response $res) {
    (new GitarokController())->editById($req->params[0]);
});

Router::post('/guitarEdit', function (Request $req, Response $res) {
    (new GitarokController())->update();
});

Router::get('/guitarDelete/([0-9]*)', function (Request $req, Response $res) {
    (new GitarokController())->deleteById($req->params[0]);
});

Router::post('/guitarDelete', function (Request $req, Response $res) {
    (new GitarokController())->delete();
});