<?php

namespace backend\modules\siti\models;

use backend\modules\siti\models\TKaryawan;
use backend\modules\siti\models\User;
use backend\modules\siti\models\TMasterCutiIzin;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class SignupForm extends Model {

    public $username;
    public $email;
    public $password;
    public $nik;
    public $nama;
    public $no_hp;
    public $inisial;
    public $id_sex;
    public $status_kawin;
    public $status_kepeg;
    public $id_jabatan;
    public $kuota_cuti;
    public $kuota_cuti_n;
    public $kuota_cuti_m;
    public $kuota_cuti_k;
    public $kuota_cuti_d;
    public $jlh_izin;
    public $id_karyawan;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\backend\modules\siti\models\User', 'message' => 'Username sudah dipakai'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['nik', 'filter', 'filter' => 'trim'],
            ['nik', 'required'],
            ['nik', 'unique', 'targetClass' => '\backend\modules\siti\models\User', 'message' => 'NIK sudah dipakai'],
            ['nik', 'string', 'min' => 3, 'max' => 255],
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            ['nama', 'filter', 'filter' => 'trim'],
            ['nama', 'required'],
            ['nama', 'unique', 'targetClass' => '\backend\modules\siti\models\TKaryawan'],
            ['nama', 'string', 'max' => 45],
            ['kuota_cuti', 'filter', 'filter' => 'trim'],
            ['kuota_cuti', 'required'],
            [['kuota_cuti_n','kuota_cuti_m','kuota_cuti_k','kuota_cuti_d'], 'required'],
            [['kuota_cuti_n','kuota_cuti_m','kuota_cuti_k','kuota_cuti_d'], 'integer'],
            ['kuota_cuti', 'integer'],
            ['jlh_izin', 'filter', 'filter' => 'trim'],
            ['jlh_izin', 'required'],
            ['jlh_izin', 'integer'],
            ['no_hp', 'filter', 'filter' => 'trim'],
            ['no_hp', 'required'],
            ['no_hp', 'unique', 'targetClass' => '\backend\modules\siti\models\TKaryawan', 'message' => 'Nomor Hp sudah dipakai'],
            ['no_hp', 'integer', 'min' => 6],
            ['inisial', 'filter', 'filter' => 'trim'],
            ['inisial', 'required'],
            ['inisial', 'unique', 'targetClass' => '\backend\modules\siti\models\TKaryawan', 'message' => 'Alias sudah dipakai'],
            ['inisial', 'string', 'max' => 45],
            ['id_sex', 'filter', 'filter' => 'trim'],
            ['id_sex', 'required'],
//            ['id_sex', 'unique', 'targetClass' => '\backend\modules\siti\models\TKaryawan'],
            ['status_kawin', 'filter', 'filter' => 'trim'],
            ['status_kawin', 'required'],
//            ['status_kawin', 'unique', 'targetClass' => '\backend\modules\siti\models\TKaryawan'],
            ['status_kepeg', 'filter', 'filter' => 'trim'],
            ['status_kepeg', 'required'],
//            ['status_kepeg', 'unique', 'targetClass' => '\backend\modules\siti\models\TKaryawan'],
            ['id_jabatan', 'filter', 'filter' => 'trim'],
            ['id_jabatan', 'required'],
//            ['id_jabatan', 'unique', 'targetClass' => '\backend\modules\siti\models\TKaryawan'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup() {
        if ($this->validate()) {
            $user = new User();

            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->nik = $this->nik;

            $user->generateAuthKey();
            if ($user->save()) {
                $TKaryawan = new TKaryawan();
                $TKaryawan->id = $user->id;
                $TKaryawan->nik = $this->nik;
                $TKaryawan->nama = $this->nama;
                $TKaryawan->email = $this->email;
                $TKaryawan->no_hp = $this->no_hp;
                $TKaryawan->inisial = $this->inisial;
                $TKaryawan->id_sex = $this->id_sex;
                $TKaryawan->status_kawin = $this->status_kawin;
                $TKaryawan->status_kepeg = $this->status_kepeg;
                $TKaryawan->id_jabatan = $this->id_jabatan;
                if ($TKaryawan->save()) {
                    $trdetail = new TMasterCutiIzin();
                    $trdetail->kuota_cuti = $this->kuota_cuti;
                    $trdetail->kuota_cuti_n = $this->kuota_cuti_n;
                    $trdetail->kuota_cuti_m = $this->kuota_cuti_m;
                    $trdetail->kuota_cuti_k = $this->kuota_cuti_k;
                    $trdetail->kuota_cuti_d = $this->kuota_cuti_d;
                    $trdetail->jlh_izin = $this->jlh_izin;
                    $trdetail->id_karyawan = $user->id;
                    $trdetail->save();
                    return $trdetail;
                }
                return $TKaryawan;
            }

            return $user;
        }

        return null;
    }





    public function attributeLabels()
    {
        return [
            'kuota_cuti' => 'Kuota Cuti Tahunan',
            'kuota_cuti_n' => 'Kuota Cuti Nikah',
            'kuota_cuti_m' => 'Kuota Cuti Melahirkan',
            'kuota_cuti_k' => 'Kuota Cuti Keguguran',
            'kuota_cuti_d' => 'Kuota Cuti Diluar Tanggungan',
            'jlh_izin' => 'Jumlah Izin',
        ];
    }


}
