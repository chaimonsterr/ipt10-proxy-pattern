<?php
declare(strict_types=1);

// 1. Shared Subject Interface
interface DocumentInterface
{
    public function display(): void;
}

// 2. Real Subject (The sensitive object)
class RealDocument implements DocumentInterface
{
    public function display(): void
    {
        echo "Displaying sensitive content: Confidential Project Data.\n";
    }
}

// 3. Protection Proxy (The security guard)
class ProxyDocument implements DocumentInterface
{
    private ?RealDocument $realDocument = null;

    public function __construct(private string $userRole) {}

    public function display(): void
    {
        if ($this->userRole === "ADMIN") {
            if ($this->realDocument === null) {
                $this->realDocument = new RealDocument();
            }
            $this->realDocument->display();
        } else {
            echo "Access Denied: You do not have permission to view this document.\n";
        }
    }
}

// --- CLIENT TEST EXECUTION ---
echo "=== PROXY DESIGN PATTERN DEMO (PHP 8) ===\n\n";

echo "[Test 1] User Role: ADMIN\n";
$adminProxy = new ProxyDocument("ADMIN");
$adminProxy->display();

echo "\n[Test 2] User Role: GUEST\n";
$guestProxy = new ProxyDocument("GUEST");
$guestProxy->display();