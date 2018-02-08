<?php
Route::get('/','portal/index/index');
Route::rule('login', 'portal/auth/login', 'GET|POST');
Route::post('login/is_recaptcha_required', 'portal/auth/checkLoginCaptchaRequired');
Route::rule('register', 'portal/auth/register', 'GET|POST');
Route::get('/logout','portal/auth/logout');
return [];
