<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Name:  Ion Auth Lang - English
 *
 * Author: Ben Edmunds
 *         ben.edmunds@gmail.com
 *         @benedmunds
 *
 * Location: https://github.com/benedmunds/CodeIgniter-Ion-Auth
 *
 * Created:  03.14.2010
 *
 * Description:  English language file for Ion Auth messages and errors
 *
 */

// Account Creation
$lang['account_creation_successful']            = 'Akun Anda berhasil dibuat';
$lang['account_creation_unsuccessful']          = 'Oppsss,, ada yang tidak beres, Akun gagal dibuat';
$lang['account_creation_duplicate_email']       = 'Oppsss,, ada yang tidak beres, Email telah digunakan';
$lang['account_creation_duplicate_identity']    = 'Oppsss,, ada yang tidak beres, Identity tidak valid';
$lang['account_creation_missing_default_group'] = 'Oppsss,, ada yang tidak beres, group default tidak dideklarasikan';
$lang['account_creation_invalid_default_group'] = 'Oppsss,, ada yang tidak beres, group default invalid';


// Password
$lang['password_change_successful']          = 'Password berhasil diubah';
$lang['password_change_unsuccessful']        = 'Oppsss,, ada yang tidak beres, ganti password gagal';
$lang['forgot_password_successful']          = 'Kami mengirimkanmu Kode Aktivasi untuk reset password, silahkan cek folder email atau spam di email Anda';
$lang['forgot_password_unsuccessful']        = 'Oppsss,, ada yang tidak beres, kami tidak bisa mengirimkan Kode Aktivasi ke emailmu';

// Activation
$lang['activate_successful']                 = 'Aktivasi akun Anda berhasil dilakukan';
$lang['activate_unsuccessful']               = 'Oppsss,, ada yang tidak beres, kami tidak bisa mengaktivasi akun Anda';
$lang['deactivate_successful']               = 'Akun telah di non aktifkan';
$lang['deactivate_unsuccessful']             = 'Oppsss,, ada yang tidak beres, akun gagal di non aktifkan';
$lang['activation_email_successful']         = 'Kami mengirimkanmu Kode Aktivasi melalui email, silahkan cek folder email atau spam di email Anda. Jika Kode Aktivasi tidak diterima, Silahkan ulangi registrasi 30 menit kemudian ';
$lang['activation_email_unsuccessful']       = 'Oppsss,, ada yang tidak beres, kami tidak bisa mengirimkan Kode Aktivasi melalui email';
$lang['deactivate_current_user_unsuccessful'] = 'Oppsss,, kamu tidak bisa menon aktifkan akunmu sendiri';

// Login / Logout
$lang['login_successful']                    = 'Login akun berhasil, jaga selalu Username dan Password Anda';
$lang['login_unsuccessful']                  = 'Oppsss,, ada yang tidak beres, Username atau Password Salah';
$lang['login_unsuccessful_not_active']       = 'Oppsss,, ada yang tidak beres, Akun anda belum di aktivasi, silahkan cek Kode Aktivasi pada folder email atau spam di email Anda';
$lang['login_timeout']                       = 'Oppsss,, ada yang tidak beres, Akun terblokir, silahkan coba beberapa menit lagi';
$lang['logout_successful']                   = 'Log Out berhasil';

// Account Changes
$lang['update_successful']                   = 'Informasi Akun berhasil di perbaharui';
$lang['update_unsuccessful']                 = 'Oppsss,, ada yang tidak beres, Gagal melakukan pembaharuan informasi Akun';
$lang['delete_successful']                   = 'User berhasil dihapus';
$lang['delete_unsuccessful']                 = 'Oppsss,, ada yang tidak beres, Gagal menghapus user';

// Groups
$lang['group_creation_successful']           = 'Group berhasil dibuat';
$lang['group_already_exists']                = 'Oppsss,, ada yang tidak beres, Group sudah ada';
$lang['group_update_successful']             = 'Detail Group berhasil diperbaharui';
$lang['group_delete_successful']             = 'Group berhasil dihapus';
$lang['group_delete_unsuccessful']           = 'Oppsss,, ada yang tidak beres, gagal menghapus Group';
$lang['group_delete_notallowed']             = 'Oppsss,, ada yang tidak beres, Group Administrator tidak dapat dihapus';
$lang['group_name_required']                 = 'Oppsss,, ada yang tidak beres, cek kembali form Anda';
$lang['group_name_admin_not_alter']          = 'Oppsss,, ada yang tidak beres, Group admin tidak dapat diubah';

// Activation Email
$lang['email_activation_subject']            = 'Learning With Deyan Email Verification';
$lang['email_activate_heading']              = 'Aktivasi akun untuk email %s';
$lang['email_activate_subheading']           = 'Hallo, terimakasih telah mendaftar di Learning With Deyan. Silahkan klik link berikut untuk %s.';
$lang['email_activate_link']                 = 'Mengaktivasi akunmu';

// Forgot Password Email
$lang['email_forgotten_password_subject']    = 'Learning With Deyan Forgotten Password Verification';
$lang['email_forgot_password_heading']       = 'Reset Password untuk email %s';
$lang['email_forgot_password_subheading']    = 'Hallo, silahkan klik link berikut untuk %s.';
$lang['email_forgot_password_link']          = 'Mereset password akunmu';