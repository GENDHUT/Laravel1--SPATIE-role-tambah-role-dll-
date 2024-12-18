<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User; // Ubah menjadi App\Models\User

class Meja extends Model
{
    use HasFactory;
    protected $table = 'meja';
    protected $fillable = [
        'nomor_meja',
        'status',
        'user_id', // Tambahkan user_id ke dalam fillable array
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
