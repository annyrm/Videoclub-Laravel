Route::get('/', function() 
{ 
return 'Pantalla Principal';
});


Route::get('login', function()
{
return 'Login usuario';
});


Route::get('logout', function()
{
return 'Logout usuario';
});


Route::get('catalog', function()
{
return 'Listado películas';
});


Route::get('catalog/show/{id}', function()
{
return 'Vista detalle palícula {id}';
});


Route::get('catalog/create', function()
{
return 'Añadir película';
});


Route::get('catalog/edit/{id}', function()
{
return 'Modificar película';
});