<?php

namespace App\Controller;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use App\Model\GitarokDao;
use App\Model\GitarKategoriakDao;

class GitarokController implements ICrudController
{
    public function list()
    {
        $data = GitarokDao::all();
        $twig = (new GitarokController())->setTwigEnvironment();
        echo $twig->render('gitar/gitarok.html.twig', ['gitarok'=>$data]);
    }

    public function add()
    {
        $twig = (new GitarokController())->setTwigEnvironment();
        $gitarok = GitarKategoriakDao::all();
        echo $twig->render('gitar/new_gitar.html.twig', ['gitarok'=>$gitarok]);
    }

    public function save()
    {
        if (isset($_POST['save'])) {
            GitarokDao::save();
            header('Location: /guitars');
        }
    }

    public function delete()
    {
        if (isset($_POST['delete'])) {
            GitarokDao::delete();
            header('Location: /guitars');
        }
    }

    public function update()
    {
        if (isset($_POST['update'])) {
            GitarokDao::update();
            header('Location: /guitars');
        }
    }


    public function editById(int $id)
    {
        $twig = (new GitarokController())->setTwigEnvironment();
        $gitarok = GitarokDao::getById($id);
        $gitarKategoriak = GitarKategoriakDao::all();
        if ($gitarok) {
            echo $twig->render('gitar/edit_gitar.html.twig', ['gitar'=>$gitarok, 'gitarKategoriak'=>$gitarKategoriak]);
        } else {
            echo $twig->render('404.html.twig');
        }
    }

    public function deleteById(int $id)
    {
        $twig = (new GitarokController())->setTwigEnvironment();
        $gitarok = GitarokDao::getById($id);
        if ($gitarok) {
            echo $twig->render('gitar/delete_gitar.html.twig', ['gitar'=>$gitarok]);
        } else {
            echo $twig->render('404.html.twig');
        }
    }

    public function setTwigEnvironment()
    {
        $loader = new FilesystemLoader(__DIR__ . '\..\View');
        $twig = new \Twig\Environment($loader, [
            'debug' => true,
        ]);
        $twig->addExtension(new \Twig\Extension\DebugExtension());
        return $twig;
    }
}