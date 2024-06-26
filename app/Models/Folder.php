<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Folder extends Model
{
    use HasFactory, HasUuids, SoftDeletes;
    protected $table = 'folder';
    protected $primaryKey = 'id';
    protected $fillable = [
        'folder_nama',
        'folder_id',
        'user_id'
    ];

    public function files(): HasMany
    {
        return $this->hasMany(File::class, 'folder_id', 'id');
    }
    public function subfolders(): HasMany
    {
        return $this->hasMany(Folder::class, 'folder_id', 'id')->with('subfolders','files');
    }
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Folder::class, 'folder_id', 'id');
    }
}
