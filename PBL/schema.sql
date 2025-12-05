CREATE EXTENSION IF NOT EXISTS "uuid-ossp";
CREATE EXTENSION IF NOT EXISTS "pg_trgm";

CREATE TYPE status_peminjaman AS ENUM ('pending', 'approved', 'rejected');
CREATE TYPE kategori_galeri AS ENUM ('activity', 'facility'); 

CREATE OR REPLACE FUNCTION update_timestamp() RETURNS TRIGGER AS $$
BEGIN
    NEW.updated_at = NOW();
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION slugify(text) RETURNS text AS $$
DECLARE s TEXT := lower($1);
BEGIN
    s := regexp_replace(s, '[^a-z0-9]+', '-', 'gi');
    s := regexp_replace(s, '(^-|-$)', '', 'g');
    RETURN s;
END;
$$ LANGUAGE plpgsql;

-- =========================================================
-- [1] AUTHENTICATION (ADMIN ONLY)
-- =========================================================

CREATE TABLE admin (
    id SERIAL PRIMARY KEY,
    nama VARCHAR(150) NOT NULL,
    username VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    last_login TIMESTAMP,
    created_at TIMESTAMP DEFAULT NOW(),
    updated_at TIMESTAMP DEFAULT NOW()
);
CREATE TRIGGER set_timestamp_admin BEFORE UPDATE ON admin FOR EACH ROW EXECUTE PROCEDURE update_timestamp();

-- =========================================================
-- [2] PROFIL DOSEN (DATA ONLY)
-- =========================================================

CREATE TABLE bidang_keahlian (
    id SERIAL PRIMARY KEY,
    nama VARCHAR(150) NOT NULL UNIQUE,
    slug VARCHAR(150) UNIQUE
);

CREATE TABLE dosen (
    id SERIAL PRIMARY KEY,
    admin_id INT REFERENCES admin(id) ON DELETE SET NULL,

    nip VARCHAR(50) UNIQUE,
    nidn VARCHAR(50) UNIQUE,
    nama VARCHAR(255) NOT NULL,
    email VARCHAR(150), 
    program_studi VARCHAR(150),
    foto VARCHAR(255),

    sinta_id VARCHAR(100),
    google_scholar_id VARCHAR(100),
    linkedin_url VARCHAR(255),

    pendidikan JSONB DEFAULT '[]'::jsonb,  -- List Pendidikan
    sertifikasi JSONB DEFAULT '[]'::jsonb, -- List Sertifikasi
    metadata JSONB DEFAULT '{}'::jsonb,    
    search_vector TSVECTOR,                -- Mesin Pencari
    
    created_at TIMESTAMP DEFAULT NOW(),
    update_at TIMESTAMP DEFAULT NOW()
);
CREATE TRIGGER set_timestamp_dosen BEFORE UPDATE ON dosen FOR EACH ROW EXECUTE PROCEDURE update_timestamp();

CREATE TABLE dosen_bidang_keahlian (
    id SERIAL PRIMARY KEY,
    dosen_id INT REFERENCES dosen(id) ON DELETE CASCADE,
    bidang_id INT REFERENCES bidang_keahlian(id) ON DELETE CASCADE,
    UNIQUE(dosen_id, bidang_id)
);

-- =========================================================
-- [3] RESEARCH & INNOVATION
-- =========================================================

CREATE TABLE kategori_riset (
    id SERIAL PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    slug VARCHAR(120) UNIQUE,
    deskripsi TEXT
);

CREATE TABLE publikasi (
    id SERIAL PRIMARY KEY,
    kategori_id INT REFERENCES kategori_riset(id) ON DELETE SET NULL,
    judul VARCHAR(255) NOT NULL,
    jenis_publikasi VARCHAR(100),
    nama_penerbit VARCHAR(255),
    tahun_terbit INT,
    doi VARCHAR(255),
    link_dokumen VARCHAR(255),
    deskripsi TEXT,
    created_at TIMESTAMP DEFAULT NOW(),
    updated_at TIMESTAMP DEFAULT NOW()
);

CREATE TABLE publikasi_penulis (
    id SERIAL PRIMARY KEY,
    publikasi_id INT REFERENCES publikasi(id) ON DELETE CASCADE,
    dosen_id INT REFERENCES dosen(id) ON DELETE CASCADE,
    urutan_penulis INT DEFAULT 1,
    peran VARCHAR(50) DEFAULT 'Penulis Anggota',
    UNIQUE (publikasi_id, dosen_id)
);


-- =========================================================
-- [4] CMS (CONTENT MANAGEMENT)
-- =========================================================


CREATE TABLE artikel (
    id SERIAL PRIMARY KEY,
    admin_id INT REFERENCES admin(id) ON DELETE SET NULL,
    judul VARCHAR(255) NOT NULL,
    slug VARCHAR(255) UNIQUE,
    isi TEXT NOT NULL,
    thumbnail VARCHAR(255),
    tanggal DATE NOT NULL DEFAULT CURRENT_DATE,
    tags VARCHAR(255),
    search_vector TSVECTOR,
    created_at TIMESTAMP DEFAULT NOW(),
    updated_at TIMESTAMP DEFAULT NOW()
);
CREATE TRIGGER set_timestamp_artikel BEFORE UPDATE ON artikel FOR EACH ROW EXECUTE PROCEDURE update_timestamp();

CREATE TABLE galeri (
    id SERIAL PRIMARY KEY,
    judul VARCHAR(150),
    deskripsi TEXT,
    gambar VARCHAR(255) NOT NULL,
    kategori kategori_galeri NOT NULL DEFAULT 'activity', -- Pembeda Aktifitas/Fasilitas
    created_at TIMESTAMP DEFAULT NOW()
);

CREATE TABLE contact_messages (
    id SERIAL PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    subjek VARCHAR(200),
    pesan TEXT NOT NULL,
    status_baca BOOLEAN DEFAULT FALSE,
    tanggal TIMESTAMP DEFAULT NOW()
);


-- =========================================================
-- [5] LOGGING & AUDIT
-- =========================================================

CREATE TABLE admin_activity_log (
    id SERIAL PRIMARY KEY,
    admin_id INT REFERENCES admin(id) ON DELETE SET NULL,
    action_type VARCHAR(20) NOT NULL,
    table_name VARCHAR(50),
    record_id INT,
    old_data JSONB,
    new_data JSONB,
    ip_address VARCHAR(45),
    user_agent TEXT,
    created_at TIMESTAMP DEFAULT NOW()
);

CREATE TABLE website_setting (
    id SERIAL PRIMARY KEY,
    
    landing_badge VARCHAR(150),
    landing_title VARCHAR(255),
    landing_description TEXT,
    landing_hero_image VARCHAR(255),

    footer_box_title VARCHAR(150),
    footer_email VARCHAR(255),
    footer_phone VARCHAR(50),
    footer_address TEXT,

    social_linkedin VARCHAR(255),
    social_instagram VARCHAR(255),
    social_youtube VARCHAR(255),

    footer_copyright_text VARCHAR(255)
        DEFAULT '© 2025 Laboratory of Business Analytics. All rights reserved.',

    created_at TIMESTAMP DEFAULT NOW(),
    updated_at TIMESTAMP DEFAULT NOW()
);

CREATE TRIGGER set_timestamp_website_setting
BEFORE UPDATE ON website_setting
FOR EACH ROW
EXECUTE PROCEDURE update_timestamp();

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

-- =========================================================
-- [6] TRIGGERS & LOGIC (AUTOMATION)
-- =========================================================

CREATE OR REPLACE FUNCTION auto_slug_trigger() RETURNS trigger AS $$
BEGIN
    IF (TG_OP = 'INSERT' OR TG_OP = 'UPDATE') THEN
        IF TG_TABLE_NAME IN ('bidang_keahlian', 'kategori_riset') THEN
             NEW.slug := slugify(NEW.nama);
        ELSIF TG_TABLE_NAME IN ('proyek', 'artikel') THEN
             IF NEW.slug IS NULL OR NEW.slug = '' THEN
                 NEW.slug := slugify(NEW.judul);
             END IF;
        END IF;
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER trg_slug_bidang BEFORE INSERT OR UPDATE ON bidang_keahlian FOR EACH ROW EXECUTE PROCEDURE auto_slug_trigger();
CREATE TRIGGER trg_slug_artikel BEFORE INSERT OR UPDATE ON artikel FOR EACH ROW EXECUTE PROCEDURE auto_slug_trigger();

CREATE OR REPLACE FUNCTION refresh_search_vector() RETURNS TRIGGER AS $$
BEGIN
    IF TG_TABLE_NAME = 'proyek' THEN
        NEW.search_vector :=
            setweight(to_tsvector('indonesian', COALESCE(NEW.judul,'')), 'A') ||
            setweight(to_tsvector('indonesian', COALESCE(NEW.teknologi::text,'')), 'B');
    ELSIF TG_TABLE_NAME = 'artikel' THEN
        NEW.search_vector :=
            setweight(to_tsvector('indonesian', COALESCE(NEW.judul,'')), 'A') ||
            setweight(to_tsvector('indonesian', COALESCE(NEW.isi,'')), 'B');
    ELSIF TG_TABLE_NAME = 'dosen' THEN
        NEW.search_vector :=
            setweight(to_tsvector('indonesian', COALESCE(NEW.nama,'')), 'A') ||
            setweight(to_tsvector('indonesian', COALESCE(NEW.program_studi,'')), 'B');
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER trg_tsv_dosen BEFORE INSERT OR UPDATE ON dosen FOR EACH ROW EXECUTE PROCEDURE refresh_search_vector();
CREATE TRIGGER trg_tsv_artikel BEFORE INSERT OR UPDATE ON artikel FOR EACH ROW EXECUTE PROCEDURE refresh_search_vector();

-- =========================================================
-- [7] INDEXES (PERFORMANCE OPTIMIZATION)
-- =========================================================
CREATE INDEX idx_search_artikel ON artikel USING GIN (search_vector);
CREATE INDEX idx_search_dosen ON dosen USING GIN (search_vector);
CREATE INDEX idx_galeri_kategori ON galeri(kategori);