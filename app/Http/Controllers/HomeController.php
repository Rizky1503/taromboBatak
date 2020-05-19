<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Guzzle\Http\Exception\ClientErrorResponseException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;


class HomeController extends BaseController
{
    public function index(){

    	$this->title = '';   
        $this->sub_title = '';
        return view('page.halaman_test')->with([
            'page' => $this
        ]);

    }

    public function login(){

    	return view('login.login');
    }

    public function loginApi(Request $request){
    	$client = new \GuzzleHttp\Client();            
    	$response = $client->request('POST', ENV('APP_URL_API').'login/login', [
    	    'form_params'   => [
    	        'username'  => $request->username,
    	        'password'  => $request->password,
    	    ]
    	]);

    	$responses = json_decode($response->getBody());

    	if ($responses->status == "true") {
            Session::put('id_username_token',$responses->cekEmail->nama);
    	    Session::put('id_member_token',$responses->cekEmail->id_member);
    	    Session::put('login',TRUE);
    	    return redirect()->route('Member.member');
    	}else{
    	    return redirect()->route('Home.login')->with('alert','Login Gagal, pastikan NIP dan passwod sesuai');
    	}
    }

    public function Logout ()
    {
        Session::flush();
        return redirect()->route('Home.login')->with('alert','Anda berhasil logout');
    }

    public function member(){
    	$this->title = 'Halaman Member';   
        $this->sub_title = '';
        $list_member = json_decode(file_get_contents(ENV('APP_URL_API').'member/list_member'));

    	return view('page.member')->with([
    	    'page' => $this,
    	    'list' => $list_member,
    	]);
    }

    public function updatemember(Request $request){
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', ENV('APP_URL_API').'member/status_member', [
                'form_params'  => [
                    'status_member'   => $request->status,
                    'id_member'       => Session::get('id_member_token')
                ]
        ]);
    }

    public function tambah_member(){
    	$this->title = 'Halaman Tambah Member';   
        $this->sub_title = '';

        $data_marga = json_decode(file_get_contents(ENV('APP_URL_API').'member/get_marga'));
        
        $data_provinsi = json_decode(file_get_contents(ENV('APP_URL_API').'member/get_provinsi'));
        
        $data_member = json_decode(file_get_contents(ENV('APP_URL_API').'member/get_member'));

    	return view('page.tambah_member')->with([
    	    'page' => $this,
    	    'marga' => $data_marga,
    	    'provinsi' => $data_provinsi,
    	    'ayah' => $data_member,
    	    'member' => $data_member,
    	]);
    }

    public function get_kota(Request $request){
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', ENV('APP_URL_API').'member/get_kota', [
                'form_params'  => [
                    'provinsi'    => $request->provinsi,
                ]
        ]);
        $kota = json_decode($response->getBody());

        echo "<option value=''>--Pilih Kota--</option>";
        foreach ($kota as $key => $value) {
            echo "<option value='".$value->kota."'>".$value->kota."</option>";
        }
    }

    public function keturunan_ke(Request $request){
    	$client = new \GuzzleHttp\Client();
        $response = $client->request('POST', ENV('APP_URL_API').'member/get_ayah', [
                'form_params'  => [
                    'id_marga' => $request->id_marga,
                    'level'    => $request->level - 1,
                ]
        ]);
        $ayah = json_decode($response->getBody());

        echo "<option value=''>--Nama Orang Tua Laki-Laki--</option>";
    	if ($ayah) {
    		foreach ($ayah as $key => $value) {
    			echo "<option value='".$value->nama."'>".$value->nama."</option>";
    		}
    	}else{
    		echo "<option value='0'>Pusat Silsilah</option>";
    	}
    }

    public function store_member(Request $request){
        	$client = new \GuzzleHttp\Client();
        $response = $client->request('POST', ENV('APP_URL_API').'member/tambah_member', [
                'form_params'  			 => [
                    'id_marga'   		 => $request->marga,
                    'nama'    			 => $request->nama,
                    'email'    			 => $request->email,
                    'no_telpon'    		 => $request->telp,
                    'alamat'			 => $request->alamat,
                    'provinsi_kelahiran' => $request->provinsi,
                    'kota_kelahiran'     => $request->kota,
                    'tanggal_lahir'    	 => $request->ttl,
                    'nama_ayah'    		 => $request->nama_ayah,
                    'referensi'    		 => $request->referensi,
                    'username'    		 => $request->username,
                    'password'    		 => $request->password,
                    'jenis_kelamin'      => $request->jenis_kelamin, 
                    'level'              => $request->level,
                    'id_member'          => $request->id_member
                ]
        ]);

        if($request->type == 'keluarga'){
            return redirect()->route('Member.HalamanMember',$request->id);
        }else{
            $id_member = json_decode($response->getBody());
            return redirect()->route('Member.HalamanMember',[$id_member]);
        }
    }

    public function HalamanMember($id){
        $this->title = 'Halaman Member ';   
        $this->sub_title = '';

        $data = json_decode(file_get_contents(ENV('APP_URL_API').'member/GetMemberFromId/'.$id));

        $data_marga = json_decode(file_get_contents(ENV('APP_URL_API').'member/get_marga'));
        
        $data_provinsi = json_decode(file_get_contents(ENV('APP_URL_API').'member/get_provinsi'));
        
        $data_member = json_decode(file_get_contents(ENV('APP_URL_API').'member/get_member'));

        return view('page.halaman_member')->with([
            'page' => $this,
            'data' => $data,
            'marga' => $data_marga,
            'provinsi' => $data_provinsi,
            'ayah' => $data_member,
            'member' => $data_member,
            'id'  => $id
        ]);
    }

    public function SelectMemberSilsilah(){    	
    	$this->title = 'Halaman Pohon silsilah';   
        $this->sub_title = '';

        $data_marga = json_decode(file_get_contents(ENV('APP_URL_API').'member/get_marga'));

    	return view('page.select_member_silsilah')->with([
    	    'page' => $this,
    	    'marga' => $data_marga,
    	]);

    }

    public function MemberFromMarga(Request $request){
    	$client = new \GuzzleHttp\Client();
        $response = $client->request('POST', ENV('APP_URL_API').'member/GetMemberForMarga', [
                'form_params'  => [
                    'id_marga'    => $request->id_marga,
                ]
        ]);
        $member = json_decode($response->getBody());

        echo "<option value=''>--Pilih Member--</option>";
		foreach ($member as $key => $value) {
			echo "<option value='".$value->id_member."'>".$value->nama."</option>";
		}
    	
    }

    public function PohonSilsilah(Request $request){
    	$this->title = 'Halaman Pohon silsilah';   
        $this->sub_title = '';

    	$client = new \GuzzleHttp\Client();
        $response = $client->request('POST', ENV('APP_URL_API').'member/PohonSilsilah', [
                'form_params'  => [
                    'id_marga'    => $request->marga,
                    'id_member'   => $request->member,
                    'urutan'	  => $request->urutan,
                ]
        ]);
        $pohon = json_decode($response->getBody());
        
        return view('page.pohon_silsilah')->with([
    	    'page' => $this,
    	    'pohon' => $pohon,
    	]);
    }	

    public function tambah_marga(){
    	$this->title = 'Halaman Tambah Marga';   
        $this->sub_title = '';

        $list_marga = json_decode(file_get_contents(ENV('APP_URL_API').'marga/list_marga'));

    	return view('page.tambah_marga')->with([
    	    'page' => $this,
    	    'list_marga' => $list_marga,
    	]);
    }

    public function store_marga(Request $request){
       $client = new \GuzzleHttp\Client();
       $response = $client->request('POST', ENV('APP_URL_API').'marga/tambah_marga', [
                'form_params'  => [
                    'marga'    => $request->nama_marga,
                    'alamat'   => $request->alamat,
                ]
        ]);
    }


}
