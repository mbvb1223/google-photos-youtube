<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperContactMessage
 */
class ContactMessage extends Model
{
    protected $fillable = [
        'name',
        'email',
        'message',
    ];
}
