<?php
date_default_timezone_set('Europe/Paris');

// Initialisation des droits des utilisateurs
auth()->createRoles([
    'admin' => ['view all','create all', 'edit all', 'delete all'],
    'booker' => ['view timesheet', 'create sessions'],
    'accountant' => ['view invoices', 'create invoices', 'close invoices'],
    'chiefaccountant' => ['view invoices', 'create invoices', 'close invoices', 'delete invoices', 'reopen invoices'],
    'caretaker' => ['view ponies', 'view records'],
    'animator' => ['view ponies', 'view timesheet', 'view clients', 'view sessions'],
    'guest' => ['view user']
]);

// Route page de connexion
app()->get('/auth/login', ['AuthController@login', 'name' => 'auth.login']);
app()->post('/auth/login', ['AuthController@check', 'name' => 'auth.check']);
app()->post('/auth/logout', ['AuthController@logout', 'name' => 'auth.logout']);
app()->get('/auth/register', ['AuthController@register', 'name' => 'auth.register']);
app()->post('/auth/register', ['AuthController@store', 'name' => 'auth.store']);

// Route accessible uniquement pour les utilisateurs connectés
app()->group('/', ['middleware' => 'auth.required', function () {

    // Route page principale
    app()->get('/', ['MainController@index','name' => 'main.index']);

    // Route tableau de bord de l'utilisateur
    app()->get('/dashboard', ['DashboardController@index','name' => 'dashboard.index']);
    app()->post('/dashboard', ['DashboardController@index','name' => 'dashboard.index']);

    // Routes qui concerne la gestion des utilisateurs
    app()->get('/users/', ['UserController@index','name' => 'users.index']);
    app()->get('/{Role}/users/', ['UserController@index','name' => 'users.index']);
    //app()->post('/users/', ['UserController@index','name' => 'users.index']);
    app()->get('/users/{id}/details', ['UserController@details','name' => 'users.details']);
    app()->post('/users/{mode}/edit', ['UserController@edit','name' => 'users.edit']);
    app()->post('/users/update', ['UserController@update','name' => 'users.update']);
    app()->get('/users/create', ['UserController@create','name' => 'users.create']);
    app()->post('/users/create', ['UserController@store','name' => 'users.store']);
    app()->post('/users/destroy', ['UserController@destroy','name' => 'users.destroy']);

    // Routes qui concerne la gestion des poneys
    app()->get('/ponies/', ['PonyController@index','name' => 'ponies.index']);
    app()->post('/ponies/', ['PonyController@index','name' => 'ponies.index']);
    app()->get('/ponies/create', ['PonyController@create','name' => 'ponies.create']);
    app()->post('/ponies/create', ['PonyController@store','name' => 'ponies.store']);
    app()->get('/ponies/{PonyId}/details', ['PonyController@details','name' => 'ponies.details']);
    app()->post('/ponies/edit', ['PonyController@edit','name' => 'ponies.edit']);
    app()->post('/ponies/update', ['PonyController@update','name' => 'ponies.update']);
    app()->post('/ponies/destroy', ['PonyController@destroy','name' => 'ponies.destroy']);

    // Routes qui concerne les dossiers médicaux des poneys
    app()->get('/ponies/{PonyId}/medical', ['MedicalController@index','name' => 'medicals.index']);
    app()->get('/ponies/medical/create', ['MedicalController@create','name' => 'medicals.create']);
    app()->post('/ponies/medical/create', ['MedicalController@store','name' => 'medicals.store']);
    app()->post('/ponies/medical/edit', ['MedicalController@edit','name' => 'medicals.edit']);
    app()->post('/ponies/medical/update', ['MedicalController@update','name' => 'medicals.update']);
    app()->post('/ponies/medical/destroy', ['MedicalController@destroy','name' => 'medicals.destroy']);

    // Routes qui concerne la gestion des clients
    app()->get('/{type}/clients/', ['ClientController@index','name' => 'clients.index']);
    app()->get('/clients/', ['ClientController@index','name' => 'clients.index']);
    app()->post('/clients/', ['ClientController@index','name' => 'clients.index']);
    app()->get('/clients/create', ['ClientController@create','name' => 'clients.create']);
    app()->post('/clients/store', ['ClientController@store','name' => 'clients.store']);
    app()->get('/clients/{ClientId}/details', ['ClientController@details','name' => 'clients.details']);
    app()->post('/clients/edit', ['ClientController@edit','name' => 'clients.edit']);
    app()->post('/clients/update', ['ClientController@update','name' => 'clients.update']);
    app()->post('/clients/destroy', ['ClientController@destroy','name' => 'clients.destroy']);

    // Routes qui concerne la gestion des temperaments
    app()->get('/ponies/temperaments/', ['TemperamentController@index','name' => 'temperaments.index']);
    app()->post('/ponies/temperaments/', ['TemperamentController@index','name' => 'temperaments.index']);
    app()->get('/ponies/temperaments/create', ['TemperamentController@create','name' => 'temperaments.create']);
    app()->post('/ponies/temperaments/create', ['TemperamentController@store','name' => 'temperaments.store']);
    app()->get('/ponies/temperaments/{TemperamentId}/details', ['TemperamentController@details','name' => 'temperaments.details']);
    app()->post('/ponies/temperaments/edit', ['TemperamentController@edit','name' => 'temperaments.edit']);
    app()->post('/ponies/temperaments/update', ['TemperamentController@update','name' => 'temperaments.update']);
    app()->post('/ponies/temperaments/destroy', ['TemperamentController@destroy','name' => 'temperaments.destroy']);

    // Routes qui concerne la gestion des factures
    app()->get('/{ClientId}/invoices/', ['InvoiceController@index','name' => 'invoices.index']);
    app()->post('/invoices/generate', ['InvoiceController@generate','name' => 'invoices.generate']);
    app()->get('/invoices/{InvoiceId}/details', ['InvoiceController@details','name' => 'invoices.details']);
    app()->get('/invoices/{InvoiceId}/paid', ['InvoiceController@paid','name' => 'invoices.paid']);
    app()->get('/invoices/{InvoiceId}/pdf', ['InvoiceController@pdf','name' => 'invoices.pdf']);
    app()->post('/invoices/store', ['InvoiceController@store','name' => 'invoices.store']);
    app()->post('/invoices/storeall', ['InvoiceController@storeall','name' => 'invoices.storeall']);
    app()->get('/invoices/edit', ['InvoiceController@edit','name' => 'invoices.edit']);
    app()->post('/invoices/destroy', ['InvoiceController@destroy','name' => 'invoices.destroy']);


    // Routes qui concerne la gestion des cours
    app()->get('/{type}/sessions/', ['SessionController@index','name' => 'sessions.index']);
    app()->post('/{type}/sessions/', ['SessionController@index','name' => 'sessions.index']);
    app()->get('/sessions/create', ['SessionController@create','name' => 'sessions.create']);
    app()->post('/sessions/create', ['SessionController@store','name' => 'sessions.store']);
    app()->get('/session/{SessionId}/details', ['SessionController@details','name' => 'sessions.details']);
    app()->post('/sessions/edit', ['SessionController@edit','name' => 'sessions.edit']);
    app()->post('sessions/update', ['SessionController@update','name' => 'sessions.update']);
    app()->post('/sessions/destroy', ['SessionController@destroy','name' => 'sessions.destroy']);

    // Routes qui concerne les clients inscrits aux cours
    app()->get('/sessionclients/{SessionId}/{Number}/create', ['SessionClientController@create','name' => 'sessionclients.create']);
    app()->post('/sessionclients/create', ['SessionClientController@store','name' => 'sessionclients.store']);
    app()->post('/sessionclients/edit', ['SessionClientController@edit','name' => 'sessionclients.edit']);
    app()->post('/sessionclients/update', ['SessionClientController@update','name' => 'sessionclients.update']);
    app()->post('/sessionclients/destroy', ['SessionClientController@destroy','name' => 'sessionclients.destroy']);

    // Routes qui concerne les poneys inscrits aux cours
    app()->get('/sessionponies/{SessionId}/{Number}/create/', ['SessionPonyController@create','name' => 'sessionponies.create']);
    app()->post('/sessionponies/create', ['SessionPonyController@store','name' => 'sessionponies.store']);
    app()->post('/sessionponies/destroy', ['SessionPonyController@destroy','name' => 'sessionponies.destroy']);

    // Routes qui concerne la gestion du planning
    app()->get('/{mode}/timesheets/', ['TimeSheetController@index','name' => 'timesheets.index']);
    app()->post('/{mode}/timesheets/', ['TimeSheetController@index','name' => 'timesheets.index']);
    app()->get('/timesheets/edit', ['TimeSheetController@edit','name' => 'timesheets.edit']);
    app()->post('/timesheets/destroy', ['TimeSheetController@destroy','name' => 'timesheets.destroy']);

    // Routes qui concerne la gestion des statistiques
    app()->get('/{type}/kpis/', ['KpiController@index','name' => 'kpis.index']);

    // Routes qui concerne la gestion des messages
    app()->get('/messages/', ['MessageController@index','name' => 'messages.index']);
    app()->post('/messages/role', ['MessageController@updaterole','name' => 'messages.updaterole']);
    app()->post('/messages/details', ['MessageController@details','name' => 'messages.details']);
    app()->post('/messages/', ['MessageController@readunread','name' => 'messages.readunread']);
    app()->post('/messages/destroy', ['MessageController@destroy','name' => 'messages.destroy']);


}]);

