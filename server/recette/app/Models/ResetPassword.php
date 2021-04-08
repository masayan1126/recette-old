<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResetPassword extends Model
{
   use HasFactory;
   protected $table = 'password_resets';
   protected $primaryKey = 'email';
   protected $keyType = 'string';
   // タイプがストリングの場合はインクリメントを「false」にしないといけない
   public $incrementing = false;

   // モデルが以下のフィールド以外を持たないようにする
   protected $fillable = [
       'email',
       'token',
   ];

  // タイムスタンプは「created_at」のフィールドだけにしたいので、「false」を指定
   public $timestamps = false;
  // 自前で用意する
   public static function boot()
   {
       parent::boot();
       static::creating(function ($model) {
           $model->created_at = $model->freshTimestamp();
      });
   }
}
