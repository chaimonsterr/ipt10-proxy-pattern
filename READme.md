# IPT10 — Proxy Structural Design Pattern Demonstration (PHP 8)

This repository contains an interactive command-line implementation of the **Proxy Design Pattern** written in PHP 8. It was developed as a practical code deliverable for the **IPT10 — Integrative Programming and Technologies** research paper.

---

## Concept: What This Sample Code Does

In object-oriented software development, creating heavy objects or exposing sensitive data directly to clients can cause performance bottlenecks and security vulnerabilities. 

This project demonstrates how a **Proxy** acts as an intermediary (a "gatekeeper" or "security guard") between the user and a sensitive business object (`RealDocument`):

1. **Role Verification (Protection Proxy):** When a user requests to view a document, the request passes through `ProxyDocument` first. The proxy checks the user's role (`ADMIN` vs `GUEST`/`STUDENT`).
2. **Access Control:** If the user is **not** an `ADMIN`, the proxy immediately blocks access with an `ACCESS DENIED` message. The heavy real document is never created or loaded into memory.
3. **Lazy Initialization & Caching (Virtual Proxy):** If the user **is** an `ADMIN`, the proxy checks if `RealDocument` has already been loaded. If it's the first request, it creates `RealDocument` on demand. On subsequent calls, it serves the document directly from memory (caching), avoiding redundant resource usage.

---

## Code Architecture & Class Breakdown

* **`DocumentInterface` (Subject Interface):** The common contract that both the Real Object and the Proxy implement (`display(): void`). This ensures the client can interact with the proxy as if it were the real object.
* **`RealDocument` (Real Subject):** The actual class containing sensitive data (`Project CyberShield` budget and classified details). It simulates an expensive operation during instantiation.
* **`ProxyDocument` (Proxy):** Holds a reference to `RealDocument`. It intercepts method calls to perform role checks and manages the lifecycle/caching of `RealDocument`.
* **Client (`index.php` CLI Prompt):** Prompts the user to enter their role dynamically using `readline()` and executes the proxy request.

---

## Prerequisites

* **PHP 8.0 or higher** installed on your machine.
* Verify your installation in your terminal:
  ```bash
  php -v

## How to run

* Run the PHP script by entering the following command: php index.php
* Enter Your Role (e.g., ADMIN, GUEST, STUDENT) - Type a role and hit Enter to see how the Proxy responds
