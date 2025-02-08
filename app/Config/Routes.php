<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Accueil::afficher');

use App\Controllers\Accueil;

$routes->get('accueil', [Accueil::class, 'afficher']);
$routes->get('accueil/(:segment)', [Accueil::class, 'afficher/$1']);


use App\Controllers\Compte;
$routes->get('compte/lister', [Compte::class, 'lister']);
$routes->get('compte/creer', [Compte::class, 'creer']);
$routes->post('compte/creer', [Compte::class, 'creer']);
$routes->get('compte/connecter', [Compte::class, 'connecter']);
$routes->post('compte/connecter', [Compte::class, 'connecter']);
$routes->get('compte/deconnecter', [Compte::class, 'deconnecter']);
$routes->get('compte/afficher_profil', [Compte::class, 'afficher_profil']);
$routes->post('compte/modifier_mot_de_passe', 'Compte::modifier_mot_de_passe');
$routes->post('compte/changer_etat_profil', [Compte::class, 'changer_etat_profil']);
$routes->get('compte/scenarios_affichage', [Compte::class, 'listerscenario']);
$routes->post('compte/detail_etapes', [Compte::class, 'listeretapes']);
$routes->get('compte/afficher_formulaire', [Compte::class, 'afficher_formulaire']);
$routes->post('compte/creer_scenario', [Compte::class, 'creer_scenario']);
$routes->post('compte/supprimer_scenario', [Compte::class, 'supprimer_scenario']);




//$routes->match(["get","post"],'compte/creer', [Compte::class, 'creer']);


use App\Controllers\Actualite;
$routes->get('actualite/afficher', [Actualite::class, 'afficher']);
$routes->get('actualite/afficher/(:num)', [Actualite::class, 'afficher']);

use App\Controllers\Scenario;

$routes->get('scenario', [Scenario::class, 'afficher']);
$routes->get('scenario/(:segment)', [Scenario::class, 'afficher/$1']);
$routes->post('scenario/ajout_participant', [Scenario::class, 'ajout_participant']);
$routes->get('scenario/afficher_premiere_etape/(:segment)/(:segment)', [Scenario::class, 'afficher_premiere_etape/$1/$2']);
$routes->get('scenario/finaliser_jeu/(:segment)/(:segment)', [Scenario::class, 'finaliser_jeu/$1/$2']);
$routes->post('scenario/finaliser_jeu/(:segment)/(:segment)', [Scenario::class, 'finaliser_jeu/$1/$2']);
$routes->post('scenario/franchir_etape/(:segment)/(:segment)', [Scenario::class, 'franchir_etape/$1/$2']);



use App\Controllers\Etape;

$routes->get('etape/afficher/(:segment)/(:segment)', [Etape::class, 'afficher/$1/$2']);



?>

