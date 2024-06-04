<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;
use App\Models\Posts;
use App\Models\User;
use App\Models\Course;
use App\Models\Aviso;
use App\Models\Subject;
// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', url('/'));
});
// Home > Asignatura
Breadcrumbs::for('asignatura.show', function (BreadcrumbTrail $trail, Subject $asignatura) {
    $trail->parent('home');
    $trail->push($asignatura->name, route('asignatura.show', $asignatura));
});
// Home > Publicación
Breadcrumbs::for('post.show', function (BreadcrumbTrail $trail, Posts $post) {
    $trail->parent('home');
    $trail->push($post->asignatura->name, route('asignatura.show', $post->asignatura));
    $trail->push($post->title, route('post.show', $post));
});
Breadcrumbs::for('post.edit', function (BreadcrumbTrail $trail, Posts $post) {
    $trail->parent('home');
    $trail->push($post->asignatura->name, route('asignatura.show', $post->asignatura));
    $trail->push($post->title, route('post.edit', $post));
});
Breadcrumbs::for('post.create', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Nueva publicación', route('post.create'));
});
// Home > Blog > [Category]
Breadcrumbs::for('perfil.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Mi perfil', route('perfil.index'));
});
Breadcrumbs::for('perfil.show', function (BreadcrumbTrail $trail, User $user) {
    $trail->parent('home');
    $trail->push($user->name, route('perfil.show', $user));
});
// Home > Search
Breadcrumbs::for('buscar', function (BreadcrumbTrail $trail, $query) {
    $trail->parent('home');
    $trail->push('Resultados de la búsqueda: "'.$query.'"', route('buscar', $query));
});
// Home > Mod
Breadcrumbs::for('moderacion.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Listado de usuarios con incidencias', route('moderacion.index'));
});
Breadcrumbs::for('moderacion.show', function (BreadcrumbTrail $trail, User $usuario) {
    $trail->parent('home');
    $trail->push($usuario->name, route('moderacion.show', $usuario));
});
// Home > Curso
Breadcrumbs::for('cursos.show', function (BreadcrumbTrail $trail, Course $curso) {
    $trail->parent('home');
    $trail->push($curso->asignatura->name, route('asignatura.show', $curso->asignatura));
    $trail->push($curso->title, route('cursos.show', $curso));
});
Breadcrumbs::for('cursos.edit', function (BreadcrumbTrail $trail, Course $curso) {
    $trail->parent('home');
    $trail->push($curso->asignatura->name, route('asignatura.show', $curso->asignatura));
    $trail->push($curso->title, route('cursos.edit', $curso));
});
Breadcrumbs::for('cursos.create', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Nuevo curso', route('cursos.create'));
});
// Home > Aviso
Breadcrumbs::for('avisos.show', function (BreadcrumbTrail $trail, Aviso $aviso) {
    $trail->parent('home');
    $trail->push($aviso->title, route('avisos.show', $aviso));
});
Breadcrumbs::for('avisos.edit', function (BreadcrumbTrail $trail, Aviso $aviso) {
    $trail->parent('home');
    $trail->push($aviso->title, route('avisos.edit', $aviso));
});
Breadcrumbs::for('avisos.create', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Nuevo aviso', route('avisos.create'));
});
// Home > Tareas
Breadcrumbs::for('tareas.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Mis tareas', route('tareas.index'));
});
