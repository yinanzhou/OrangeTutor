<?php
Route::get('/','portal/index/index');
Route::rule('login', 'portal/auth/login', 'GET|POST');
Route::post('login/is_recaptcha_required', 'portal/auth/checkLoginCaptchaRequired');
Route::rule('register', 'portal/auth/register', 'GET|POST');
Route::get('/logout','portal/auth/logout');

Route::get('dashboard', 'portal/dashboard.general/home');

Route::rule('student/enroll', 'portal/dashboard.student/enroll', 'GET|POST');
Route::get('refer', 'portal/dashboard.student/refer');

Route::rule('tutor/enroll', 'portal/dashboard.tutor/enroll', 'GET|POST');
return [];
