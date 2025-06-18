public array $aliases = [
    'csrf'       => \CodeIgniter\Filters\CSRF::class,
    'toolbar'    => \CodeIgniter\Filters\DebugToolbar::class,
    'honeypot'   => \CodeIgniter\Filters\Honeypot::class,
    'invalidchars' => \CodeIgniter\Filters\InvalidChars::class,
    'secureheaders' => \CodeIgniter\Filters\SecureHeaders::class,

    'guestOnly' => \App\Filters\GuestOnly::class,
    'roleGuard' => \App\Filters\RoleGuard::class,
];