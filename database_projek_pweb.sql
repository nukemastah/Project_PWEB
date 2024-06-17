--bikin database projek web admin PWEB
create database projek_pweb

--menggunakan database projek_pweb
use projek_pweb

--hapus table
drop table dbo.pelanggan
drop table dbo.hjual
drop table dbo.djual
drop table dbo.dbayarjual
drop table dbo.rekening
drop table dbo.dbayarbeli
drop table dbo.pemasok
drop table dbo.hbeli
drop table dbo.item
drop table dbo.dbeli

--lihat detail tabel
exec sp_help pelanggan
exec sp_help hjual
exec sp_help djual
exec sp_help dbayarjual
exec sp_help rekening
exec sp_help dbayarbeli
exec sp_help pemasok
exec sp_help hbeli
exec sp_help item
exec sp_help dbeli

--tabel rekening primary key = koderekening (fix)
create table rekening (
	koderekening varchar(5),
	namarekening varchar(255),
	saldo float, --harusnya double; (float sementara)
	primary key (koderekening)
)

--tabel pemasok primary key = kodepemasok (fix)
create table pemasok (
	kodepemasok varchar(5),
	namapemasok varchar(50),
	alamat varchar(255),
	kota varchar(25),
	telepon varchar(15),
	email varchar(255),
	primary key (kodepemasok)
)

--tabel item primary key = kodeitem (fix)
create table item (
	kodeitem varchar(5),
	nama varchar(25),
	hargabeli float, --harusnya double; (float sementara)
	hargajual float, --harusnya double; (float sementara)
	stok float, --harusnya double; (float sementara)
	satuan varchar(10),
	primary key (kodeitem)
)

--tabel pelanggan primary = kodepelanggan (fix)
create table pelanggan (
	kodepelanggan varchar(9),
	namapelanggan varchar(50),
	alamat varchar(50),
	kota varchar(25),
	telepon varchar(15),
	email varchar(255),
	primary key (kodepelanggan)
)

--tabel hjual foreign key = pelanggan(kodepelanggan), primary key = nojual (fix)
create table hjual (
	nojual varchar(5),
	tanggal date,
	kodepelanggan varchar(9),
	total float, --harusnya double; (float sementara)
	keterangan varchar(255),
	primary key (nojual),
	foreign key (kodepelanggan) references pelanggan(kodepelanggan)
)

--tabel hbeli foreign key = pemasok(kodepemasok), primary key = nobeli (fix)
create table hbeli (
	nobeli varchar(5),
	noref varchar(100),
	tanggal date,
	kodepemasok varchar(5),
	total float, --harusnya double; (float sementara)
	keterangan varchar(255),
	primary key (nobeli),
	foreign key (kodepemasok) references pemasok(kodepemasok)
)

--tabel dbayarjual foreign key = hjual(nojual), rekening(koderekening), primary key = nomer_dbayarjual (fix)
create table dbayarjual (
	nojual varchar(5),
	nomer_dbayarjual integer,
	tanggal datetime,
	totalbayar float, --harusnya double; (float sementara)
	keterangan varchar(255),
	koderekening varchar(5),
	primary key (nomer_dbayarjual),
	foreign key (nojual) references hjual(nojual),
	foreign key (koderekening) references rekening(koderekening)
)

--tabel dbayarbeli foreign key = hbeli(nobeli), rekening(koderekening), primary key = nomer_dbayarbeli (fix)
create table dbayarbeli (
	nobeli varchar(5),
	nomer_dbayarbeli integer,
	tanggal datetime,
	totalbayar float, --harusnya double; (float sementara)
	keterangan varchar(255),
	koderekening varchar(5),
	primary key (nomer_dbayarbeli),
	foreign key (nobeli) references hbeli(nobeli),
	foreign key (koderekening) references rekening(koderekening)
)

--tabel djual foreign key = hjual(nojual), primary key = nogenerate (fix)
create table djual (
	nojual varchar(5),
	nogenerate varchar(10),
	qty float, --harusnya double; (float sementara)
	hargajual float, --harusnya double; (float sementara)
	primary key (nogenerate),
	foreign key(nojual) references hjual(nojual)
)

--tabel dbeli foreign key = djual(nogenerate), hbeli(nobeli), item(kodeitem) (fix)
create table dbeli (
	nogenerate varchar(10),
	nobeli varchar(5),
	kodeitem varchar(5),
	qty float, --harusnya double; (float sementara)
	hargabeli float, --harusnya double; (float sementara)
	stok float, --harusnya double; (float sementara)
	foreign key (nogenerate) references djual(nogenerate),
	foreign key (nobeli) references hbeli(nobeli),
	foreign key (kodeitem) references item(kodeitem)
)