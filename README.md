## Cara Instalasi

1. Download / Clone https://github.com/dimasaddriansyah/POS-ShervieJuice.git
2. Buka Folder POS-ShervieJuice
3. Buka CMD / Git Bash
4. Ketik "composer install"
5. Ketik "cp .env.example .env"
6. Buat Database "project_pos" di phpmyadmin
7. Buka File .env
8. Setting Database sama dengan yang di phpmyadmin
9. Ketik php artisan migrate --seed
10. Ketik php artisan key:generate
11. ketik php artisan serve

## Login

-   Pemilik
    email : dimas@gmail.com
    password : dimas
    email : pemilik@gmail.com
    password : pemilik

-   Pegawai
    email : ayunda@gmail.com
    password : ayunda
    email : triana@gmail.com
    password : triana
    email : pegawai@gmail.com
    password : pegawai
