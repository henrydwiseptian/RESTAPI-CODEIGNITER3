# REST-API-CODEIGNITER-CRUD

This is a REST API project with Codeigniter 3 and Sql Server 2008 R2

1. CREATE DATABASE IN SQL SERVER

============================= CREATE TABLE =============================


```
CREATE TABLE mahasiswa (
    Id int NOT NULL IDENTITY(1,1) PRIMARY KEY ,
    [nrp] varchar(50),
    nama varchar(50),
    email varchar(50),
    jurusan varchar(50)
); 
```

============================= INSERT DATA =============================


```
insert into mahasiswa ([nrp], nama,email, jurusan) 
values 
('2016102773','Henry Dwi Septian','henrydwiseptian@gmail.com','informatika'),
('2016102774','Goldy Widiyanto','goldywy@gmail.com','DKV'),
('2016102775','Reza Khalafi','mrezakhalafi@gmail.com','sistem informasi'),
('2016102776','Matrix Indra','matrixindra@gmail.com','ilmu komunikasi')
```

2. MAKE API CRUD

    - index_get By ID (READ)
    ![image](https://user-images.githubusercontent.com/53201265/147721475-bb1f5c29-88b3-4d2f-8041-713c1ed92233.png)
    - index_get All (READ)
    ![image](https://user-images.githubusercontent.com/53201265/147722708-4ad5f66e-aa7d-4c3d-ab62-87028cf1208d.png)
    - index_delete (DELETE)
    ![image](https://user-images.githubusercontent.com/53201265/147723996-768939bd-aff9-46d1-977c-c7c42cb63571.png)
    - index_post (CREATE)
    ![image](https://user-images.githubusercontent.com/53201265/216224089-38f2d4bf-1e7e-4032-b97d-21e55bd1e027.png)
    - index_put (UPDATE)
    ![image](https://user-images.githubusercontent.com/53201265/216224154-9aafe1f4-1618-4c19-ae19-453c877cadab.png)


3. Description HTTP REQUEST in this project
```
HTTP_OK             => 200
HTTP_BAD_REQUEST    => 400
HTTP_NO_CONTENT     => 204
HTTP_CREATED        => 201
```

ENJOY CODING !!!




