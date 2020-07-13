<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Name:  Auth Lang - English
 *
 * Author: Ben Edmunds
 * 		  ben.edmunds@gmail.com
 *         @benedmunds
 *
 * Author: Daniel Davis
 *         @ourmaninjapan
 *
 * Location: https://github.com/benedmunds/CodeIgniter-Ion-Auth
 *
 * Created:  03.09.2013
 *
 * Description:  English language file for Ion Auth example views
 *
 */

// Errors
$lang['error_csrf'] = 'Form yang dikirim tidak lulus pemeriksaan keamanan kami.';

// Login
$lang['login_heading']         = 'Login';
$lang['login_subheading']      = 'Silahkan login menggunakan Email dan Kata Sandi yang telah didaftarkan sebelumnya';
$lang['login_identity_label']  = 'Email:';
$lang['login_password_label']  = 'Kata Sandi:';
$lang['login_remember_label']  = 'Ingat saya:';
$lang['login_submit_btn']      = 'Login';
$lang['login_forgot_password'] = 'Lupa Password?';

// Index
$lang['index_heading']           = 'Users';
$lang['index_subheading']        = 'Berikut merupakan daftar user yang telah mendaftar';
$lang['index_fname_th']          = 'Nama Depan';
$lang['index_lname_th']          = 'Nama Belakang';
$lang['index_email_th']          = 'Email';
$lang['index_groups_th']         = 'Group';
$lang['index_status_th']         = 'Status';
$lang['index_action_th']         = 'Aksi';
$lang['index_active_link']       = 'Aktif';
$lang['index_inactive_link']     = 'Non-Aktif';
$lang['index_create_user_link']  = 'Tambah User';
$lang['index_create_group_link'] = 'Tambah Group';

// Deactivate User
$lang['deactivate_heading']                  = 'Non Aktifkan User';
$lang['deactivate_subheading']               = 'Apakah anda yakin akan menon-aktifkan user \'%s\'';
$lang['deactivate_confirm_y_label']          = 'Iya:';
$lang['deactivate_confirm_n_label']          = 'Tidak:';
$lang['deactivate_submit_btn']               = 'Submit';
$lang['deactivate_validation_confirm_label'] = 'konfirmasi';
$lang['deactivate_validation_user_id_label'] = 'user ID';

// Create User
$lang['create_user_heading']                           = 'Registrasi Akun';
$lang['create_user_subheading']                        = 'Silahkan masukkan informasi tentang Anda dengan benar dan valid, segala informasi yang anda berikan akan dijaga kerahasiaannya';
$lang['create_user_fname_label']                       = 'Nama Depan:';
$lang['create_user_lname_label']                       = 'Nama Belakang:';
$lang['create_user_company_label']                     = 'Asal Sekolah/Universitas:';
$lang['create_user_identity_label']                    = 'Identitas:';
$lang['create_user_email_label']                       = 'Email:';
$lang['create_user_phone_label']                       = 'No WA:';
$lang['create_user_password_label']                    = 'Kata Sandi:';
$lang['create_user_password_confirm_label']            = 'Konfirmasi Kata Sandi:';
$lang['create_user_submit_btn']                        = 'Kirimkan Saya Kode Verifikasi';
$lang['create_user_validation_fname_label']            = 'Nama Depan';
$lang['create_user_validation_lname_label']            = 'Nama Belakang';
$lang['create_user_validation_identity_label']         = 'Identitas';
$lang['create_user_validation_email_label']            = 'Email';
$lang['create_user_validation_phone_label']            = 'No WA';
$lang['create_user_validation_company_label']          = 'Asal Sekolah/Universitas';
$lang['create_user_validation_password_label']         = 'Kata Sandi';
$lang['create_user_validation_password_confirm_label'] = 'Konfirmasi Kata Sandi';

// Edit User
$lang['edit_user_heading']                           = 'Edit User';
$lang['edit_user_subheading']                        = 'Silahkan masukkan informasi tentang Anda dengan benar dan valid, segala informasi yang anda berikan akan dijaga kerahasiaannya';
$lang['edit_user_fname_label']                       = 'Nama Depan:';
$lang['edit_user_lname_label']                       = 'Nama Belakang:';
$lang['edit_user_company_label']                     = 'Asal Sekolah/Universitas:';
$lang['edit_user_email_label']                       = 'Email:';
$lang['edit_user_phone_label']                       = 'No WA:';
$lang['edit_user_password_label']                    = 'Kata Sandi: (Jika Kamu Ingin Menggantinya)';
$lang['edit_user_password_confirm_label']            = 'Konfirmasi Kata Sandi: (Jika Kamu Mengganti Passwordmu)';
$lang['edit_user_groups_heading']                    = 'Group';
$lang['edit_user_submit_btn']                        = 'Simpan Informasi';
$lang['edit_user_validation_fname_label']            = 'Nama Depan';
$lang['edit_user_validation_lname_label']            = 'Nama Belakang';
$lang['edit_user_validation_email_label']            = 'Email';
$lang['edit_user_validation_phone_label']            = 'No WA';
$lang['edit_user_validation_company_label']          = 'Asal Sekolah/Universitas';
$lang['edit_user_validation_groups_label']           = 'Group';
$lang['edit_user_validation_password_label']         = 'Kata Sandi';
$lang['edit_user_validation_password_confirm_label'] = 'Konfirmasi Kata Sandi';

// Create Group
$lang['create_group_title']                  = 'Tambah Group';
$lang['create_group_heading']                = 'Tambah Group';
$lang['create_group_subheading']             = 'Silahkan masukkan informasi tentang Group';
$lang['create_group_name_label']             = 'Nama Group:';
$lang['create_group_desc_label']             = 'Deskripsi:';
$lang['create_group_submit_btn']             = 'Tambah Group';
$lang['create_group_validation_name_label']  = 'Nama Group';
$lang['create_group_validation_desc_label']  = 'Deskripsi';

// Edit Group
$lang['edit_group_title']                  = 'Edit Group';
$lang['edit_group_saved']                  = 'Group Disimpan';
$lang['edit_group_heading']                = 'Edit Group';
$lang['edit_group_subheading']             = 'Silahkan masukkan informasi tentang Group';
$lang['edit_group_name_label']             = 'Nama Group:';
$lang['edit_group_desc_label']             = 'Deskripsi:';
$lang['edit_group_submit_btn']             = 'Simpan Group';
$lang['edit_group_validation_name_label']  = 'Nama Group';
$lang['edit_group_validation_desc_label']  = 'Deskripsi';

// Change Password
$lang['change_password_heading']                               = 'Ubah Kata Sandi';
$lang['change_password_old_password_label']                    = 'Kata Sandi Lama:';
$lang['change_password_new_password_label']                    = 'Kata Sandi Baru (at least %s characters long):';
$lang['change_password_new_password_confirm_label']            = 'Konfirmasi Kata Sandi Baru:';
$lang['change_password_submit_btn']                            = 'Ubah Kata Sandi';
$lang['change_password_validation_old_password_label']         = 'Kata Sandi Lama';
$lang['change_password_validation_new_password_label']         = 'Kata Sandi Baru';
$lang['change_password_validation_new_password_confirm_label'] = 'Konfirmasi Kata Sandi Baru';

// Forgot Password
$lang['forgot_password_heading']                 = 'Lupa Kata Sandi';
$lang['forgot_password_subheading']              = 'Silahkan masukkan %s yang telah terdaftar di sistem';
$lang['forgot_password_email_label']             = '%s:';
$lang['forgot_password_submit_btn']              = 'Submit';
$lang['forgot_password_validation_email_label']  = 'Email';
$lang['forgot_password_identity_label'] = 'Identity';
$lang['forgot_password_email_identity_label']    = 'Email';
$lang['forgot_password_email_not_found']         = 'Oppss... Email tidak ditemukan';
$lang['forgot_password_identity_not_found']         = 'Oppss... Username tidak ditemukan';

// Reset Password
$lang['reset_password_heading']                               = 'Ubah Kata Sandi';
$lang['reset_password_new_password_label']                    = 'Kata Sandi Baru (panjang katasandi minimal %s karakter):';
$lang['reset_password_new_password_confirm_label']            = 'Konfirmasi Kata Sandi:';
$lang['reset_password_submit_btn']                            = 'Simpan Informasi';
$lang['reset_password_validation_new_password_label']         = 'Kata Sandi Baru';
$lang['reset_password_validation_new_password_confirm_label'] = 'Konfirmasi Kata Sandi';