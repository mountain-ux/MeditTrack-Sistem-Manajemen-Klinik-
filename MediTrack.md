
<div align="center">

# **MediTrack (Sistem Manajemen Klinik)**

<div align="center">
   <img src="Logo%20Unsulbar.png" width="250">
</div>

### **Nama:** Hasnur
### **NIM:** D0223509

## FRAMEWORK WEB BASED
### 2025

</div>


## 🏷️ Role dan Fitur-Fitur
### 1. **🛠️ Admin**
- Mengelola data pengguna (dokter & pasien).
- Menyusun dan memantau stok obat.
- Memverifikasi transaksi obat.
- Mengelola jadwal konsultasi dokter.

### 2. **👨‍⚕️ Dokter**
- Melihat daftar pasien dan riwayat medis.
- Menjadwalkan konsultasi.
- Menyusun dan mengelola resep obat.

### 3. **🧑‍⚕️ Pasien**
- Mendaftar dan mengelola profil.
- Melihat jadwal konsultasi.
- Menerima resep dan membeli obat.

## 🗃️ Tabel Database
Berikut adalah tabel-tabel utama beserta field dan tipe datanya:

### **👥 pengguna**
| 🏷️ Field        | 📂 Tipe Data     | ℹ️ Keterangan         |
|-------------|--------------|--------------------|
| id          | BigInteger (PK) | ID unik pengguna |
| nama        | String       | Nama pengguna     |
| email       | String       | Email pengguna    |
| kata_sandi | String       | Kata sandi pengguna |
| peran       | Enum: Admin, Dokter, Pasien | Jenis peran pengguna |
| created_at  | Timestamp    | Waktu dibuat      |
| updated_at  | Timestamp    | Waktu diperbarui  |

### **🧑‍⚕️ pasien**
| 🏷️ Field        | 📂 Tipe Data     | ℹ️ Keterangan          |
|-------------|--------------|---------------------|
| id          | BigInteger (PK) | ID unik pasien    |
| id_pengguna | BigInteger (FK) | ID pengguna terkait |
| tanggal_lahir | Date       | Tanggal lahir pasien |
| jenis_kelamin | String    | Jenis kelamin      |
| telepon     | String      | Nomor telepon pasien |
| alamat      | Text        | Alamat pasien      |
| riwayat_medis | Text      | Riwayat medis pasien |
| created_at  | Timestamp   | Waktu dibuat       |
| updated_at  | Timestamp   | Waktu diperbarui   |

### **👨‍⚕️ dokter**
| 🏷️ Field        | 📂 Tipe Data     | ℹ️ Keterangan          |
|-------------|--------------|---------------------|
| id          | BigInteger (PK) | ID unik dokter    |
| id_pengguna | BigInteger (FK) | ID pengguna terkait |
| spesialisasi | String      | Bidang spesialisasi dokter |
| telepon     | String      | Nomor telepon dokter |
| jadwal_praktik | Text    | Jadwal konsultasi dokter |
| created_at  | Timestamp   | Waktu dibuat       |
| updated_at  | Timestamp   | Waktu diperbarui   |

### **📅 jadwal_konsultasi**
| 🏷️ Field        | 📂 Tipe Data     | ℹ️ Keterangan          |
|-------------|--------------|---------------------|
| id          | BigInteger (PK) | ID unik jadwal    |
| id_pasien   | BigInteger (FK) | ID pasien terkait |
| id_dokter   | BigInteger (FK) | ID dokter terkait |
| tanggal_konsultasi | Date | Tanggal konsultasi |
| status      | Enum: Menunggu, Dikonfirmasi, Selesai | Status konsultasi |
| created_at  | Timestamp   | Waktu dibuat       |
| updated_at  | Timestamp   | Waktu diperbarui   |

### **💊 resep_obat**
| 🏷️ Field        | 📂 Tipe Data     | ℹ️ Keterangan          |
|-------------|--------------|---------------------|
| id          | BigInteger (PK) | ID unik resep    |
| id_jadwal_konsultasi | BigInteger (FK) | ID jadwal konsultasi terkait |
| id_dokter   | BigInteger (FK) | ID dokter terkait |
| id_pasien   | BigInteger (FK) | ID pasien terkait |
| detail_obat | Text        | Detail obat yang diresepkan |
| created_at  | Timestamp   | Waktu dibuat       |
| updated_at  | Timestamp   | Waktu diperbarui   |

### **🩺 obat**
| 🏷️ Field        | 📂 Tipe Data     | ℹ️ Keterangan          |
|-------------|--------------|---------------------|
| id          | BigInteger (PK) | ID unik obat     |
| nama        | String       | Nama obat        |
| deskripsi   | Text        | Deskripsi obat   |
| stok        | Integer     | Jumlah stok obat |
| harga       | Decimal     | Harga per unit   |
| created_at  | Timestamp   | Waktu dibuat      |
| updated_at  | Timestamp   | Waktu diperbarui  |

### **💰 transaksi**
| 🏷️ Field        | 📂 Tipe Data     | ℹ️ Keterangan          |
|-------------|--------------|---------------------|
| id          | BigInteger (PK) | ID unik transaksi |
| id_pasien   | BigInteger (FK) | ID pasien terkait |
| id_obat     | BigInteger (FK) | ID obat terkait   |
| jumlah      | Integer      | Jumlah obat dibeli |
| total_harga | Decimal     | Total harga transaksi |
| tanggal_transaksi | Date | Tanggal transaksi |
| created_at  | Timestamp   | Waktu dibuat       |
| updated_at  | Timestamp   | Waktu diperbarui   |

### **🛠 Hubungan Antar Tabel**

1. **pengguna** memiliki hubungan **One-to-Many** dengan tabel **pasien** dan **dokter**.  
   - `id_pengguna` di tabel **pasien** dan **dokter** merujuk ke `id` di tabel **pengguna**.
   
2. **dokter** dan **pasien** memiliki hubungan **Many-to-Many** melalui tabel **jadwal_konsultasi**.  
   - `id_dokter` dan `id_pasien` di tabel **jadwal_konsultasi** masing-masing merujuk ke `id` di tabel **dokter** dan **pasien**.
   
3. **jadwal_konsultasi** memiliki hubungan **One-to-One** dengan tabel **resep_obat**.  
   - `id_jadwal_konsultasi` di tabel **resep_obat** merujuk ke `id` di tabel **jadwal_konsultasi**.
   
4. **resep_obat** memiliki hubungan **One-to-Many** dengan tabel **obat**.  
   - `detail_obat` di tabel **resep_obat** mencantumkan daftar obat yang diresepkan oleh dokter.
   
5. **pasien** memiliki hubungan **Many-to-Many** dengan **obat** melalui tabel **transaksi**.  
   - `id_pasien` dan `id_obat` di tabel **transaksi** merujuk ke tabel **pasien** dan **obat**, memungkinkan pembelian obat oleh pasien.


