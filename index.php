<?php
declare(strict_types=1);

// ==========================================
// 1. Shared Subject Interface
// ==========================================
interface DocumentInterface
{
    public function display(): void;
}

// ==========================================
// 2. Real Subject (Heavy/Sensitive Object)
// ==========================================
class RealDocument implements DocumentInterface
{
    public function __construct()
    {
        // Simulates a heavy operation (e.g., loading a large confidential file)
        echo "   [SYSTEM] Loading confidential database file into memory...\n";
    }

    public function display(): void
    {
        echo "\n=============================================\n";
        echo "   CONFIDENTIAL DOCUMENT DATA:\n";
        echo "   - Project Name: Operation CyberShield\n";
        echo "   - Budget: $1,500,000\n";
        echo "   - Status: Highly Classified\n";
        echo "=============================================\n\n";
    }
}

// ==========================================
// 3. Protection & Caching Proxy
// ==========================================
class ProxyDocument implements DocumentInterface
{
    private ?RealDocument $realDocument = null;

    public function __construct(private string $userRole) {}

    public function display(): void
    {
        // Convert role to uppercase for safe comparison
        $role = strtoupper(trim($this->userRole));

        echo "\n   [PROXY] Checking authorization for role '{$role}'...\n";

        // Access Control (Protection Proxy)
        if ($role !== 'ADMIN') {
            echo "   [PROXY] ACCESS DENIED! You do not have permission to view this document.\n\n";
            return;
        }

        echo "   [PROXY] Access Granted!\n";

        // Lazy Loading & Caching (Virtual Proxy)
        if ($this->realDocument === null) {
            echo "   [PROXY] Initializing real document for the first time...\n";
            $this->realDocument = new RealDocument();
        } else {
            echo "   [PROXY] Serving existing document from proxy memory (Cached)...\n";
        }

        // Delegate execution to the real subject
        $this->realDocument->display();
    }
}

// ==========================================
// 4. Interactive CLI Client
// ==========================================
echo "=============================================\n";
echo "   IPT10 PROXY DESIGN PATTERN DEMONSTRATION  \n";
echo "=============================================\n";

// Prompt the user for input
echo "Enter your user role (e.g., ADMIN, GUEST, STUDENT): ";
$inputRole = readline();

// Instantiate the proxy with the user's input role
$proxy = new ProxyDocument($inputRole);

// First call attempt
echo "\n--- First Request Attempt ---";
$proxy->display();

// If the user is an admin, attempt a second request to show caching in action
if (strtoupper(trim($inputRole)) === 'ADMIN') {
    echo "--- Second Request Attempt (Testing Cache) ---";
    $proxy->display();
}
