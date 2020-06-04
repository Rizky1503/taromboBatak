<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::group(['as'=>'Home.'], function(){
    Route::get('/', 'HomeController@login')->name('login');
    Route::get('/login', 'HomeController@login')->name('login');
    Route::get('/loginApi', 'HomeController@loginApi')->name('loginApi');
    Route::get('/Logout', 'HomeController@Logout')->name('Logout');
});

Route::group(['as'=>'Member.'], function(){ 
    Route::get('/member', 'HomeController@member')->name('member');
    Route::get('/updatemember', 'HomeController@updatemember')->name('updatemember');
    
    Route::get('/tambah_member', 'HomeController@tambah_member')->name('tambah_member');
    Route::get('/get_kota', 'HomeController@get_kota')->name('get_kota');
    Route::get('/keturunan_ke', 'HomeController@keturunan_ke')->name('keturunan_ke');
    Route::get('/store_member', 'HomeController@store_member')->name('store_member');
    
    Route::get('/MemberFromMarga', 'HomeController@MemberFromMarga')->name('MemberFromMarga');
    
    Route::get('/SelectMemberSilsilah', 'HomeController@SelectMemberSilsilah')->name('SelectMemberSilsilah');
    Route::get('/PohonSilsilah', 'HomeController@PohonSilsilah')->name('PohonSilsilah');

    Route::get('/HalamanMember/{id}', 'HomeController@HalamanMember')->name('HalamanMember');

    Route::get('/edit_member/{id}', 'HomeController@edit_member')->name('edit_member');
    Route::get('/UpdateDataMember', 'HomeController@UpdateDataMember')->name('UpdateDataMember');

});

Route::group(['as'=>'Marga.'], function(){
    Route::get('/tambah_marga', 'HomeController@tambah_marga')->name('tambah_marga');
    Route::get('/store_marga', 'HomeController@store_marga')->name('store_marga');
    Route::get('/update_marga', 'HomeController@update_marga')->name('update_marga');
});