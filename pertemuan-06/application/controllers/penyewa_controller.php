<?php
require_once APPPATH . 'models/Penyewa_model.php';

class Penyewa_controller extends Controller
{
    private Penyewa_model $model;

    public function __construct()
    {
        $this->model = new Penyewa_model();
    }

    public function profil(): void
    {
        if (empty($_SESSION['penyewa_user_plg'])) {
            $_SESSION['flash_penyewa_nav'] = 'Silakan login terlebih dahulu untuk mengakses profil.';
            header('Location: ' . site_url('auth/login-penyewa'));
            exit;
        }

        $userPlg = (string) $_SESSION['penyewa_user_plg'];

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $profil = $this->model->getProfil($userPlg);
            $flash = $_SESSION['flash_profil_penyewa'] ?? null;
            unset($_SESSION['flash_profil_penyewa']);
            $this->view('penyewa/profil', ['profil' => $profil, 'flash' => $flash, 'error' => null]);
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nik = trim($_POST['nik'] ?? '');
            $nama = trim($_POST['nm_lngkp'] ?? '');
            $noHp = trim($_POST['no_hp'] ?? '');
            $alamat = trim($_POST['almt_lngkp'] ?? '');
            $passwordSaatIni = (string) ($_POST['password_saat_ini'] ?? '');
            $passwordBaru = (string) ($_POST['password_baru'] ?? '');

            $profil = $this->model->getProfil($userPlg);
            $passwordHashBaru = null;

            if ($passwordBaru !== '') {
                if (!$this->model->verifikasiPassword($userPlg, $passwordSaatIni)) {
                    $this->view('penyewa/profil', ['profil' => $profil, 'error' => 'Password saat ini tidak sesuai.']);
                    return;
                }
                $passwordHashBaru = password_hash($passwordBaru, PASSWORD_DEFAULT);
            }

            $uploadKtp = $this->uploadFotoPenyewa('ft_ktp');
            $uploadSim = $this->uploadFotoPenyewa('ft_sim_a');

            $ftKtpBaru = $uploadKtp['filename'] ?? ($profil['ft_ktp'] ?? null);
            $ftSimBaru = $uploadSim['filename'] ?? ($profil['ft_sim_a'] ?? null);

            $this->model->updateProfil($userPlg, $nik, $nama, $noHp, $alamat, $ftKtpBaru, $ftSimBaru, $passwordHashBaru);
            $_SESSION['flash_profil_penyewa'] = 'Profil berhasil diperbarui.';
            header('Location: ' . site_url('penyewa/profil'));
            exit;
        }
    }

    private function uploadFotoPenyewa(string $field): array
    {
        if (!isset($_FILES[$field]) || $_FILES[$field]['error'] === UPLOAD_ERR_NO_FILE) {
            return ['success' => true, 'filename' => null];
        }

        $file = $_FILES[$field];
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = $field . '_' . date('YmdHis') . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
        $targetDir = APPPATH . '../uploads/penyewa/';

        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        move_uploaded_file($file['tmp_name'], $targetDir . $filename);
        return ['success' => true, 'filename' => $filename];
    }
}