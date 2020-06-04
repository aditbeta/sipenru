USE sipenru;

-- role: 0 = admin, 1 = staff, 2 = mahasiswa
INSERT INTO User (username, password, email, nama, no_handphone, bagian, role) VALUES
('admin', 'admin', 'admin@mail.com', 'Admin', '080000000000', 'SUPER ADMIN', 0),
('user', 'user', 'user@mail.com', 'User', '080000000001', 'Mahasiswa Teknik Informatika', 1);

INSERT INTO Ruangan (kode, nama, deskripsi) VALUES
('111', '111', 'Gedung 1 Lantai 1 Ruangan 1'),
('112', '112', 'Gedung 1 Lantai 1 Ruangan 2'),
('113', '113', 'Gedung 1 Lantai 1 Ruangan 3'),
('114', '114', 'Gedung 1 Lantai 1 Ruangan 4'),
('115', '115', 'Gedung 1 Lantai 1 Ruangan 5');

-- status: 0 = tersedia; 1 = digunakan
INSERT INTO KetersediaanRuangan (kode_ruangan, tanggal, jam_mulai, jam_selesai, status) VALUES
('111', now(), '08:00:00', '09:50:00', 0),
('111', now(), '10:00:00', '11:50:00', 0),
('112', now(), '12:00:00', '15:00:00', 1),
('112', now(), '16:00:00', '18:00:00', 0),
('113', now(), '10:00:00', '11:50:00', 2);

-- status: 0 = menunggu; 1 = diterima, 2 = ditolak
INSERT INTO PenggunaanRuangan (id_ketersediaan, id_user, tanggal_pengajuan, keterangan, status) VALUES
(2, 2, '2019-03-31', 'Kelas Pengganti PWEB', 0),
(4, 1, '2019-03-31', 'Rapat Persiapan UTS', 0),
(4, 2, '2019-03-31', 'Pertemuan Mahasiswa Kelas S6G', 0);