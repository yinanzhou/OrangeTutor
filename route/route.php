<?php
Route::get('/','portal/index/index');
Route::rule('login', 'portal/auth/login', 'GET|POST');
Route::post('login/is_recaptcha_required', 'portal/auth/checkLoginCaptchaRequired');
Route::rule('register', 'portal/auth/register', 'GET|POST');
Route::get('/logout','portal/auth/logout');

Route::get('dashboard', 'portal/dashboard.general/home');
Route::get('dashboard/profile', 'portal/dashboard.general/profile');

Route::rule('student/enroll', 'portal/dashboard.student/enroll', 'GET|POST');
Route::get('refer', 'portal/dashboard.student/refer');
Route::get('student/appointments', 'portal/dashboard.student/appointments');
Route::get('student/pay', 'portal/dashboard.student/payment');
Route::post('student/pay/paypal', 'portal/dashboard.student/redirectToPaypal');

Route::rule('tutor/enroll', 'portal/dashboard.tutor/enroll', 'GET|POST');
Route::get('tutor/appointments', 'portal/dashboard.tutor/appointments');

Route::get('admin/users', 'portal/dashboard.admin/users');
Route::post('admin/users/set_user_status', 'portal/dashboard.admin/setUserStatus');

return [];
