USE sipenru;

-- role: 0 = admin, 1 = personalia, 2 = karyawan
INSERT INTO `user` (`id`, `username`, `password`, `email`, `nama`, `no_handphone`, `bagian`, `role`) VALUES
(1, 'admin', 'admin', 'admin@mail.com', 'Admin', '080000000000', 'admin', 0),
(2, 'user', 'user', 'user@mail.com', 'User', '080000000001', 'personalia', 1);

INSERT INTO `ruangan` (`id`, `kode`, `nama`, `deskripsi`) VALUES
(6, 'P1', 'Pluto', 'Ruang diskusi, kapasitas 5 orang'),
(7, 'M1', 'Mars', 'Ruang rapat kapasitas 10 orang'),
(8, 'M2', 'Merkurius', 'Ruang pertemuan kapasitas 10 orang'),
(9, 'J1', 'Jupiter', 'Ruang rapat besar kapasitas 25 orang, dilengkapi 1 proyektor dan 2 TV. '),
(10, 'V1', 'Venus', 'Ruang Diskusi dengan kapasitas 4 orang tanpa proyektor');

-- status: 0 = tersedia; 1 = digunakan
INSERT INTO `ketersediaanruangan` (`id`, `kode_ruangan`, `tanggal`, `jam_mulai`, `jam_selesai`, `status`) VALUES
(7, 'P1', '2020-06-09', '08:00:00', '10:00:00', 0),
(9, 'P1', '2020-06-09', '13:00:00', '16:00:00', 0),
(10, 'M1', '2020-06-10', '10:00:00', '13:00:00', 0),
(11, 'J1', '2020-06-16', '08:00:00', '15:00:00', 1),
(12, 'V1', '2020-08-22', '10:00:00', '12:00:00', 0),
(13, 'V1', '2020-08-20', '13:00:00', '14:00:00', 1),
(14, 'V1', '2020-08-20', '14:00:00', '15:00:00', 0);

-- status: 0 = menunggu; 1 = diterima, 2 = ditolak
INSERT INTO `penggunaanruangan` (`id`, `id_ketersediaan`, `id_user`, `tanggal_pengajuan`, `keterangan`, `status`) VALUES
(4, 11, 1, '2020-06-09 06:44:04', 'Rapat perancangan anggaran', 1),
(5, 7, 1, '2020-06-09 07:38:14', 'Rapat teknisi', 0),
(6, 9, 2, '2020-06-09 07:40:45', 'Laporan hasil penjualan', 2),
(7, 10, 2, '2020-06-09 07:41:37', 'Laporan pengeluaran', 0),
(8, 10, 1, '2020-06-09 07:43:46', 'Laporan penggajian karyawan', 2),
(10, 13, 2, '2020-08-19 04:48:42', 'Diskusi target penjualan tahun 2021', 1);