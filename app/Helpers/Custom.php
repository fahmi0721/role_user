<?php
namespace App\Helpers;

use Request;
use Image;
use File;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Custom {
	public function search_menu($array, $search_list) {
  
        $result = array();
        foreach ($array as $key => $value) {
            foreach ($search_list as $k => $v) {
                if (!isset($value[$k]) || $value[$k] != $v)
                {
                    continue 2;
                }
            }
            $result[] = $value;
        }
        return $result;
    }

	public function get_id_menu($url){
		return DB::table('m_menu')
				   ->select("id","nama_menu")
				   ->where("url",$url)
				   ->get()->first();

	}

	public function get_menu_akses(){
        $id_role = Session::get("role")->id_role;
        $menu_akses = DB::table('t_role_menu')
                      ->select('id_role','id_menu','status_tambah','status_edit','status_hapus','status_tampil','status')
                      ->where('id_role',$id_role)->get();

        return json_encode($menu_akses);
    }

	public function cek_akses_menu($url,$menu_all){
        $search_id_menu = array("id_menu" => Custom::get_id_menu($url)->id );
        return Custom::search_menu($menu_all,$search_id_menu)[0];
    }

	public static function conver_rupiah($nilai) {
		return number_format($nilai,0,',','.');
	}

	public static function conver_angka($nilai) {
		return preg_replace("[[^A-Za-z0-9]]", "", $nilai);
	}

	public static function bulan_indo($bulan) {
		$bulans = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
		return $bulans[$bulan-1];
	}
	
	public static function uploadImg($imgFile, $nmImg, $uploadDir, $dimensiImg, $dimensi_thumbnail) {
		$dir_path	= public_path($uploadDir);
		$file 		= $imgFile;
		$nmImg 		= $nmImg;
		if (!File::isDirectory($dir_path)) {
			File::makeDirectory($dir_path);
		}
		$width 	= Image::make($file)->width();
		$height = Image::make($file)->height();
		if ($dimensiImg==0) {
			$thumb_width 	= $width;
			$thumb_height 	= $height;
		} else {
			$thumb_width 	= $dimensiImg;
			$thumb_height 	= ($thumb_width/$width) * $height;
		}
		$canvas 		= Image::canvas($thumb_width, $thumb_height);
		$resizeImage  	= Image::make($file)->resize($thumb_width, $thumb_height, function($constraint) {
			$constraint->aspectRatio();
		});
		$canvas->insert($resizeImage, 'center');
		$canvas->save($dir_path.$nmImg);

		if(!empty($dimensi_thumbnail)) {
			foreach ($dimensi_thumbnail as $res_dimensi) {
				$nm_thumbnail 		= $res_dimensi[0]."x".$res_dimensi[1]."-".$nmImg;
				$canvas_thumbnail 	= Image::canvas($res_dimensi[0], $res_dimensi[1]);
				$size_thumbnail  	= Image::make($file)->fit($res_dimensi[0], $res_dimensi[1]);
				$canvas_thumbnail->insert($size_thumbnail, 'center');
				$canvas_thumbnail->save($dir_path."/".$nm_thumbnail);
			}
		}
		return true;
	}

	public static function uploadFile($File, $nmFile, $uploadDir) {
		$dir_path	= public_path($uploadDir);
		$file 		= $File;
		$nmFile 	= $nmFile;
		if (!File::isDirectory($dir_path)) {
			File::makeDirectory($dir_path);
		}
		$destinationPath = $dir_path;
		$File->move($destinationPath,$nmFile);
		return true;
	}

	public static function deleteImg($imgFile, $uploadDir, $dimensi_thumbnail) {
		$dir_path	= public_path($uploadDir);
		File::delete($dir_path . '/' . $imgFile);
		if(!empty($dimensi_thumbnail)) {
			foreach ($dimensi_thumbnail as $res_dimensi) {
				$nm_thumbnail 		= $res_dimensi[0]."x".$res_dimensi[1]."-".$imgFile;
				File::delete($dir_path."/".$nm_thumbnail);
			}
		}
		return true;
	}

	public static function deleteFile($imgFile, $uploadDir) {
		$dir_path	= public_path($uploadDir);
		File::delete($dir_path . '/' . $imgFile);
		return true;
	}

	public static function nameFile($file) {
		$ext 		= $file->getClientOriginalExtension();
		$file_name 	= $file->getClientOriginalName();
		$nmImg 		= date("YmdHis")."_".substr(md5($file_name.date('Y-m-d H:i:s')), 0, 25).".".$ext;
		return $nmImg;
	}

	public static function nameImg($file) {
		$ext 		= $file->getClientOriginalExtension();
		$file_name 	= $file->getClientOriginalName();
		$nmImg 		= substr(md5($file_name.date('Y-m-d H:i:s')), 0, 25).".".$ext;
		return $nmImg;
	}

    public static function messages() {
		return [
			'accepted' => 'Isian :attribute harus diterima.',
			'active_url' => 'Isian :attribute bukan URL yang valid.',
			'after' => 'Isian :attribute harus tanggal setelah :date.',
			'after_or_equal' => 'Isian :attribute harus berupa tanggal setelah atau sama dengan tanggal :date.',
			'alpha' => 'Isian :attribute hanya boleh berisi huruf.',
			'alpha_dash' => 'Isian :attribute hanya boleh berisi huruf, angka, dan strip.',
			'alpha_num' => 'Isian :attribute hanya boleh berisi huruf dan angka.',
			'array' => 'Isian :attribute harus berupa sebuah array.',
			'before' => 'Isian :attribute harus tanggal sebelum :date.',
			'before_or_equal' => 'Isian :attribute harus berupa tanggal sebelum atau sama dengan tanggal :date.',
			'between' => [
				'numeric' => 'Isian :attribute harus antara :min dan :max.',
				'file' => 'Isian :attribute harus antara :min dan :max kilobytes.',
				'string' => 'Isian :attribute harus antara :min dan :max karakter.',
				'array' => 'Isian :attribute harus antara :min dan :max item.',
			],
			'boolean' => 'Isian :attribute harus berupa true atau false',
			'confirmed' => 'Konfirmasi :attribute tidak cocok.',
			'date' => 'Isian :attribute bukan tanggal yang valid.',
			'date_format' => 'Isian :attribute tidak cocok dengan format :format.',
			'different' => 'Isian :attribute dan :other harus berbeda.',
			'digits' => 'Isian :attribute harus berupa angka :digits.',
			'digits_between' => 'Isian :attribute harus antara angka :min dan :max.',
			'dimensions' => 'Form :attribute tidak memiliki dimensi gambar yang valid.',
			'distinct' => 'Form isian :attribute memiliki nilai yang duplikat.',
			'email' => 'Isian :attribute harus berupa alamat surel yang valid.',
			'exists' => 'Isian :attribute yang dipilih tidak valid.',
			'file' => 'Form :attribute harus berupa sebuah berkas.',
			'filled' => 'Isian :attribute harus memiliki nilai.',
			'image' => 'Isian :attribute harus berupa gambar.',
			'in' => 'Isian :attribute yang dipilih tidak valid.',
			'in_array' => 'Form isian :attribute tidak terdapat dalam :other.',
			'integer' => 'Isian :attribute harus merupakan bilangan bulat.',
			'ip' => 'Isian :attribute harus berupa alamat IP yang valid.',
			'ipv4' => 'Isian :attribute harus berupa alamat IPv4 yang valid.',
			'ipv6' => 'Isian :attribute harus berupa alamat IPv6 yang valid.',
			'json' => 'Isian :attribute harus berupa JSON string yang valid.',
			'max' => [
				'numeric' => 'Isian :attribute seharusnya tidak lebih dari :max.',
				'file' => 'Isian :attribute seharusnya tidak lebih dari :max kilobytes.',
				'string' => 'Isian :attribute seharusnya tidak lebih dari :max karakter.',
				'array' => 'Isian :attribute seharusnya tidak lebih dari :max item.',
			],
			'mimes' => 'Isian :attribute harus dokumen berjenis : :values.',
			'mimetypes' => 'Isian :attribute harus dokumen berjenis : :values.',
			'min' => [
				'numeric' => 'Isian :attribute harus minimal :min.',
				'file' => 'Isian :attribute harus minimal :min kilobytes.',
				'string' => 'Isian :attribute harus minimal :min karakter.',
				'array' => 'Isian :attribute harus minimal :min item.',
			],
			'not_in' => 'Isian :attribute yang dipilih tidak valid.',
			'numeric' => 'Isian :attribute harus berupa angka.',
			'present' => 'Form isian :attribute wajib ada.',
			'regex' => 'Format isian :attribute tidak valid.',
			'required' => 'Form isian :attribute wajib diisi.',
			'required_if' => 'Form isian :attribute wajib diisi bila :other adalah :value.',
			'required_unless' => 'Form isian :attribute wajib diisi kecuali :other memiliki nilai :values.',
			'required_with' => 'Form isian :attribute wajib diisi bila terdapat :values.',
			'required_with_all' => 'Form isian :attribute wajib diisi bila terdapat :values.',
			'required_without' => 'Form isian :attribute wajib diisi bila tidak terdapat :values.',
			'required_without_all' => 'Form isian :attribute wajib diisi bila tidak terdapat ada :values.',
			'same' => 'Isian :attribute dan :other harus sama.',
			'size' => [
				'numeric' => 'Isian :attribute harus berukuran :size.',
				'file' => 'Isian :attribute harus berukuran :size kilobyte.',
				'string' => 'Isian :attribute harus berukuran :size karakter.',
				'array' => 'Isian :attribute harus mengandung :size item.',
			],
			'string' => 'Isian :attribute harus berupa string.',
			'timezone' => 'Isian :attribute harus berupa zona waktu yang valid.',
			'unique' => 'Isian :attribute sudah ada sebelumnya.',
			'uploaded' => 'Isian :attribute gagal diunggah.',
			'url' => 'Format isian :attribute tidak valid.',
			'custom' => [
				'attribute-name' => [
					'rule-name' => 'custom-message',
				],
			],
			'attributes' => [],
		];
	}
	

}