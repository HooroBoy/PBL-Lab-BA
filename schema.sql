CREATE TABLE admin(
    id SERIAL NOT NULL,
    nama character varying(100) NOT NULL,
    email character varying(100) NOT NULL,
    password character varying(100) NOT NULL,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT admin_pkey PRIMARY KEY (id)
);
CREATE TABLE peminjaman (
    id SERIAL NOT NULL,
    nama_peminjam character varying(100) NOT NULL,
    no_induk character varying(20) NOT NULL,
    tanggal_mulai date NOT NULL,
    tanggal_selesai date NOT NULL,
    jam_mulai time NOT NULL,
    jam_selesai time NOT NULL,
    keperluan text NOT NULL,
    status character varying(20) DEFAULT 'menunggu' CHECK (status IN ('diterima', 'ditolak', 'menunggu')),
    admin_id integer NULL,
    alasan_penolakan TEXT NULL,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT peminjaman_pkey PRIMARY KEY (id),
    CONSTRAINT fk_admin FOREIGN KEY (admin_id)
        REFERENCES admin (id) MATCH SIMPLE
        ON DELETE NO ACTION
);
CREATE TABLE jadwal_tidak_tersedia(
    id SERIAL NOT NULL,
    waktu TIMESTAMP without time zone NOT NULL,
    keterangan TEXT NOT NULL,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT hari_tidak_tersedia_pkey PRIMARY KEY (id),
    admin_id INTEGER NULL,
    CONSTRAINT fk_admin_hari_tidak_tersedia FOREIGN KEY (admin_id)
        REFERENCES admin (id) MATCH SIMPLE
        ON DELETE NO ACTION
);
DROP TABLE IF EXISTS Peminjaman;
