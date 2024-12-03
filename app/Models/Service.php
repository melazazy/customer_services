<?php

namespace App\Models;

use App\Traits\HasFileUploads;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory, HasFileUploads;

    protected $fillable = [
        'name',
        'description',
        'icon',
        'image_url',
        'status'
    ];

    protected $casts = [
        'status' => 'string'
    ];

    // Relationships
    public function requests()
    {
        return $this->hasMany(Request::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }
    // Helper methods
    public function uploadImage($file)
    {
        if ($this->image_url) {
            $this->deleteFile($this->image_url);
        }

        $path = $this->uploadFile($file, 'services/images');
        $this->update(['image_url' => $path]);
    }

    public function deleteImage()
    {
        if ($this->deleteFile($this->image_url)) {
            $this->update(['image_url' => null]);
            return true;
        }
        return false;
    }
}
