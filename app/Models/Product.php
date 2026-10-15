<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'description', 'price', 'segment', 'image',
        'power', 'acceleration', 'top_speed', 'seats', 'drivetrain',
    ];

    public const SEGMENTS = [
        'suv'      => 'SUV',
        'sportcar' => 'Sportcar',
        'sedan'    => 'Sedan',
    ];

    /** Format angka menjadi Rupiah, mis. Rp 1.900.000.000 */
    public static function rupiah(int|float $amount): string
    {
        return 'Rp ' . number_format($amount, 0, ',', '.');
    }

    public function getPriceFormattedAttribute(): string
    {
        return self::rupiah($this->price);
    }

    public function getSegmentLabelAttribute(): string
    {
        return self::SEGMENTS[$this->segment] ?? ucfirst($this->segment);
    }

    /**
     * Gambar bawaan ada di public/img/..., gambar unggahan admin di storage/app/public.
     */
    public function getImageUrlAttribute(): ?string
    {
        if (! $this->image) {
            return null;
        }

        return str_starts_with($this->image, 'img/')
            ? asset($this->image)
            : asset('storage/' . $this->image);
    }
}
