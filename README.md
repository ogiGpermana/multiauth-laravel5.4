## Multi Auth Login, Register dan Reset Password Laravel 5.4

Tutorialnya

1. Membuat project di direktori yang sudah ditentukan dengan perintah sbb:
```laravel new multiauth```
   Saya asumsikan teman-teman sudah mengerti cara meng generatenya melalui terminal pada linux atau CMD pada windows, langkah selanjutnya pindah ke direktori project yang telah dibuat kemudian jalankan perintah sbb:
```php artisan serve```
```Laravel development server started: <http://127.0.0.1:8000>```
2. Mengaktifkan auth dengan petintah sbb:
```php artisan make:auth```
```Authentication scaffolding generated successfully.```
3. Membuat AdminHomeController dengan perintah sbb:
```php artisan make:controller AdminHomeController```
```Controller created successfully.```
   Tambahkan kode seperti berikut:
```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminHomeController extends Controller
{
    public function index(){
        return view("admin.dashboard");
    }
}
```
   Buat view file dengan nama ``dashboard.blade.php`` untuk menampilkan halaman pada saat user berhasil login kodenya sbb:
```html
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">ADMIN Dashboard</div>

                <div class="panel-body">
                    Hallo Admin!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
```
4. Buka file ``web.php`` yang ada pada folder routes kemudian tambahkan satu baris kode seperti     berikut:
```php
Route::get('/admin', 'AdminHomeController@index')->name('admin.dashboard');
```
5. Membuat model Admin dengan perintah sbb:
```php artisan make:model Admin -m```
   perintah diatas akan menggenerate file AdminUser dan tabel admin_users secara otomatis, buka dan modifikasi kedua filenya sbb:
```php
// Admin.php
<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
  use Notifiable;
  protected $guard = 'admin';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'name', 'email', 'password', 'avatar', 'job_title', 'about'
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
      'password', 'remember_token',
  ];

}

```
```php
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('avatar')->nullable();
            $table->string('job_title')->nullable();
            $table->text('about')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
```
