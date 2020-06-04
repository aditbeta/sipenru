CREATE DATABASE IF NOT EXISTS sipenru;

USE sipenru;

-- role: 0 = admin, 1 = non-admin
CREATE TABLE IF NOT EXISTS User (
	id INT(20) UNSIGNED AUTO_INCREMENT,
	username VARCHAR(20) NOT NULL,
	password VARCHAR(20) NOT NULL,
	email VARCHAR(20),
	nama VARCHAR(40),
	no_handphone VARCHAR(20),
	bagian VARCHAR(20),
	role INT(20),
	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS Ruangan (
	id INT(20) UNSIGNED AUTO_INCREMENT,
	kode VARCHAR(20) NOT NULL UNIQUE,
	nama VARCHAR(50) NOT NULL,
	deskripsi TEXT,
	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- status: 0 = tersedia; 1 = digunakan
CREATE TABLE IF NOT EXISTS KetersediaanRuangan (
	id INT(20) UNSIGNED AUTO_INCREMENT,
	kode_ruangan VARCHAR(20) NOT NULL,
	tanggal DATE NOT NULL,
	jam_mulai TIME NOT NULL,
	jam_selesai TIME NOT NULL,
	status INT(20),
	PRIMARY KEY (id),
	FOREIGN KEY (kode_ruangan) REFERENCES Ruangan(kode) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- status: 0 = diajukan; 1 = diterima, 2 = ditolak
CREATE TABLE IF NOT EXISTS PenggunaanRuangan (
	id INT(20) UNSIGNED AUTO_INCREMENT,
	id_ketersediaan INT(20) UNSIGNED NOT NULL,
	id_user INT(20) UNSIGNED NOT NULL,
	tanggal_pengajuan DATETIME NOT NULL,
	keterangan VARCHAR(144),
	status INT(20),
	PRIMARY KEY (id),
	FOREIGN KEY (id_ketersediaan) REFERENCES KetersediaanRuangan(id),
	FOREIGN KEY (id_user) REFERENCES User(id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;