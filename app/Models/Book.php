<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'title',
        'author',
        'publisher',
        'price',
        'stock',
        'cover_image',
        'description',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function getFormattedPriceAttribute(): string
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    public function getCoverUrlAttribute(): string
    {
        if ($this->cover_image) {
            if (Str::startsWith($this->cover_image, ['http://', 'https://'])) {
                return $this->cover_image;
            }

            if (file_exists(public_path($this->cover_image))) {
                return asset($this->cover_image);
            }

            if (Storage::disk('public')->exists($this->cover_image)) {
                return Storage::url($this->cover_image);
            }
        }

        return $this->generateDefaultCoverSvg();
    }

    public function generateDefaultCoverSvg(): string
    {
        $palettes = [
            ['#1e293b', '#0f172a'],
            ['#450a0a', '#2b0606'],
            ['#064e3b', '#022c22'],
            ['#3b1d11', '#1f0d07'],
            ['#1c1917', '#0c0a09'],
        ];

        $paletteIndex = ($this->id ?? 1) % count($palettes);
        $theme = $palettes[$paletteIndex];
        $bgStart = $theme[0];
        $bgEnd = $theme[1];

        $title = $this->title ?? 'Buku Pustaka';
        $author = $this->author ?? 'Penulis';

        $words = explode(' ', $title);
        $lines = [];
        $currentLine = '';
        foreach ($words as $word) {
            if (mb_strlen($currentLine . ' ' . $word) > 20 && !empty($currentLine)) {
                $lines[] = trim($currentLine);
                $currentLine = $word;
            } else {
                $currentLine .= ' ' . $word;
            }
            if (count($lines) >= 3) break;
        }
        if (!empty($currentLine) && count($lines) < 3) {
            $lines[] = trim($currentLine);
        }
        if (count($words) > 7 && count($lines) >= 3) {
            $lines[2] = rtrim($lines[2], '.') . '...';
        }

        $textElements = '';
        $startY = 240 - (count($lines) * 16);
        foreach ($lines as $idx => $line) {
            $y = $startY + ($idx * 32);
            $safeLine = htmlspecialchars($line, ENT_QUOTES, 'UTF-8');
            $textElements .= "<text x=\"200\" y=\"{$y}\" text-anchor=\"middle\" fill=\"#fef3c7\" font-family=\"Georgia, serif\" font-size=\"20\" font-weight=\"bold\">{$safeLine}</text>";
        }

        $safeAuthor = htmlspecialchars(mb_strtoupper(Str::limit($author, 30)), ENT_QUOTES, 'UTF-8');

        $svg = <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 580" width="400" height="580">
  <defs>
    <linearGradient id="bgGrad" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" stop-color="{$bgStart}" />
      <stop offset="100%" stop-color="{$bgEnd}" />
    </linearGradient>
    <linearGradient id="spineShadow" x1="0%" y1="0%" x2="100%" y2="0%">
      <stop offset="0%" stop-color="#000000" stop-opacity="0.45" />
      <stop offset="60%" stop-color="#000000" stop-opacity="0.1" />
      <stop offset="100%" stop-color="#ffffff" stop-opacity="0.08" />
    </linearGradient>
  </defs>

  <rect width="400" height="580" rx="8" fill="url(#bgGrad)" />
  <rect x="0" y="0" width="30" height="580" rx="4" fill="url(#spineShadow)" />
  <line x1="30" y1="0" x2="30" y2="580" stroke="#000000" stroke-opacity="0.3" stroke-width="1.5" />

  <rect x="42" y="22" width="336" height="536" rx="6" fill="none" stroke="#b45309" stroke-width="2" />
  <rect x="48" y="28" width="324" height="524" rx="4" fill="none" stroke="#f59e0b" stroke-width="1" stroke-opacity="0.5" stroke-dasharray="5 3" />

  <circle cx="200" cy="85" r="20" fill="#b45309" fill-opacity="0.25" stroke="#f59e0b" stroke-width="1" />
  <path d="M192 85 L200 77 L208 85 L200 93 Z" fill="#f59e0b" />
  <text x="200" y="125" text-anchor="middle" fill="#d4cbb8" font-family="system-ui, sans-serif" font-size="10" font-weight="700" letter-spacing="3">BOOKSTORE PUSTAKA</text>

  <line x1="120" y1="145" x2="280" y2="145" stroke="#b45309" stroke-width="1" stroke-opacity="0.5" />
  <circle cx="200" cy="145" r="3" fill="#f59e0b" />

  {$textElements}

  <line x1="120" y1="390" x2="280" y2="390" stroke="#b45309" stroke-width="1" stroke-opacity="0.5" />
  <circle cx="200" cy="390" r="3" fill="#f59e0b" />

  <text x="200" y="425" text-anchor="middle" fill="#fde68a" font-family="system-ui, sans-serif" font-size="12" font-weight="600" letter-spacing="1.5">{$safeAuthor}</text>

  <rect x="130" y="488" width="140" height="24" rx="4" fill="#000000" fill-opacity="0.35" stroke="#b45309" stroke-width="1" />
  <text x="200" y="504" text-anchor="middle" fill="#e5dfd3" font-family="system-ui, sans-serif" font-size="9" font-weight="600" letter-spacing="1.5">OFFICIAL EDITION</text>
</svg>
SVG;

        return 'data:image/svg+xml;base64,' . base64_encode($svg);
    }
}
