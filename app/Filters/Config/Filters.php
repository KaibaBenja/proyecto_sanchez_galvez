public $aliases = [
'csrf' => \CodeIgniter\Filters\CSRF::class,
'toolbar' => \CodeIgniter\Filters\DebugToolbar::class,
'honeypot' => \CodeIgniter\Filters\Honeypot::class,
'roleGuard' => \App\Filters\RoleGuard::class,
'guestOnly' => \App\Filters\GuestOnly::class,
];