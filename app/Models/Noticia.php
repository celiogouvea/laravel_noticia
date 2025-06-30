<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    use HasFactory;

    /**
     * Os atributos que podem ser preenchidos em massa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'titulo',
        'conteudo',
        'user_id',
    ];

    /**
     * Obtém o usuário que é dono da notícia.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}